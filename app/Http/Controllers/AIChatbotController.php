<?php

namespace App\Http\Controllers;

use App\Models\Category; // Gunakan Model Category
use App\Models\UserCategoryAssessment;
use App\Models\UserOverallSummary;
use App\Models\SimulationSession; // Opsional
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenAI;
use Illuminate\Support\Str;

class AIChatbotController extends Controller
{
    protected $openaiClient;

    public function __construct()
    {
        $useOpenRouter = config('services.openrouter.enabled', false);

        if ($useOpenRouter) {
            $this->openaiClient = OpenAI::factory()
                ->withBaseUri('https://openrouter.ai/api/v1')
                ->withApiKey(config('services.openrouter.api_key'))
                ->withHttpHeader('HTTP-Referer', config('app.url'))
                ->withHttpHeader('X-Title', config('app.name'))
                ->make();
        } else {
            $this->openaiClient = OpenAI::client(config('services.openai.api_key'));
        }
    }
    // ... setelah fungsi public function submitSimulationAnswer(Request $request) { ... }

    /**
     * Memanggil API OpenAI/OpenRouter dengan prompt yang diberikan.
     *
     * @param string $prompt
     * @param string $systemMessage
     * @return string
     */
    protected function callOpenAI(string $prompt, string $systemMessage = 'Anda adalah AI yang sangat membantu.'): string
    {
        $model = config('services.openrouter.enabled')
            ? config('services.openrouter.model')
            : 'gpt-4o'; // Atau model default lainnya

        $chatResponse = $this->openaiClient->chat()->create([
            'model' => $model,
            'messages' => [
                ['role' => 'system', 'content' => $systemMessage],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.5, // Temperature lebih rendah untuk output yang lebih terstruktur
            'max_tokens' => 2048,
        ]);

        return $chatResponse->choices[0]->message->content;
    }

    /**
     * Mengekstrak blok JSON dari string teks mentah.
     *
     * @param string $rawText
     * @return string|null
     */
    protected function extractJson(string $rawText): ?string
    {
        if (preg_match('/\{[\s\S]*\}/', $rawText, $matches)) {
            return $matches[0];
        }
        return null;
    }


    public function index()
    {
        $user = Auth::user();
        $userCoins = $user->coins ?? 100; // Ambil dari kolom 'coins'

        // Ambil kategori dari database beserta pertanyaan terkait
        $categoriesFromDB = Category::with('questions')->get();

        $categoriesForView = $categoriesFromDB->mapWithKeys(function ($category) {
            return [$category->slug => [ // Gunakan slug sebagai key
                'id' => $category->id, // ID database asli
                'slug' => $category->slug,
                'label' => $category->label,
                'description' => $category->description,
                'icon_identifier' => $category->icon_identifier,
                'questions' => $category->questions->pluck('text')->all(), // Hanya text pertanyaan
                'question_objects' => $category->questions, // Seluruh objek pertanyaan jika dibutuhkan
                'cost_per_question' => $category->cost_per_question,
            ]];
        })->all();

        $completedAssessments = UserCategoryAssessment::where('user_id', $user->id)
            ->with('category:id,slug,label') // Ambil juga data kategori terkait
            ->get();

        // Ubah formatnya agar mudah digunakan oleh JavaScript
        $userProgress = [];
        foreach ($completedAssessments as $assessment) {
            if ($assessment->category) { // Pastikan relasi kategori ada
                $userProgress[$assessment->category->label] = [
                    'categoryIdKey' => $assessment->category->slug,
                    'questions' => collect($assessment->questions_data)->pluck('question_text')->all(),
                    'answers' => collect($assessment->questions_data)->pluck('answer_text')->all(),
                    'summary' => $assessment->summary_text,
                ];
            }
        }
        return view('chatbot', [
            'categories' => $categoriesForView,
            'userCoins' => (int) $userCoins,
            'userProgress' => $userProgress,
        ]);
    }

    // Helper methods getUserCoins, decrementUserCoins, incrementUserCoins
    // bisa tetap ada atau langsung menggunakan $user->coins, $user->decrement('coins', $amount), $user->increment('coins', $amount)
    // Pastikan $user->save() dipanggil jika tidak menggunakan metode increment/decrement Eloquent.

    private function getUserCoins($user)
    {
        return $user->coins ?? 0; // Default ke 0 jika null
    }

    private function decrementUserCoins($user, $amount)
    {
        if ($user->coins >= $amount) {
            $user->decrement('coins', $amount); // Eloquent akan otomatis save
            return true;
        }
        return false;
    }

    private function incrementUserCoins($user, $amount)
    {
        $user->increment('coins', $amount); // Eloquent akan otomatis save
    }


    public function getCategorySummary(Request $request)
    {
        $user = Auth::user();
        $categorySlug = $request->input('categoryId'); // Frontend sekarang mengirim slug
        $numQuestionsSelected = (int)$request->input('numQuestions');
        $answers = $request->input('answers');

        $category = Category::with('questions')->where('slug', $categorySlug)->first();

        if (!$category) {
            return response()->json(['error' => 'Kategori tidak valid.'], 400);
        }

        $costPerQuestion = $category->cost_per_question ?? 15;
        $totalCost = $numQuestionsSelected * $costPerQuestion;

        if ($this->getUserCoins($user) < $totalCost) {
            return response()->json(['error' => 'Koin tidak cukup untuk ' . $numQuestionsSelected . ' pertanyaan di kategori ini.'], 402);
        }

        // Ambil pertanyaan yang sesuai (objek pertanyaan, bukan hanya teks)
        $questionsAskedObjects = $category->questions->slice(0, $numQuestionsSelected);
        $questionsForPromptText = $questionsAskedObjects->pluck('text')->all();

        // Membuat data pertanyaan dan jawaban untuk disimpan
        $questionsDataForStorage = [];
        foreach ($questionsAskedObjects as $index => $questionObj) {
            $questionsDataForStorage[] = [
                'question_id' => $questionObj->id,
                'question_text' => $questionObj->text,
                'answer_text' => $answers[$index] ?? 'Tidak dijawab',
            ];
        }

        $prompt = "Anda adalah seorang AI konselor karir yang membantu siswa menemukan rekomendasi jurusan kuliah.\n";
        $prompt .= "Kategori saat ini adalah: \"{$category->label}\".\n";
        $prompt .= "Siswa telah menjawab {$numQuestionsSelected} pertanyaan berikut:\n";
        foreach ($questionsForPromptText as $index => $questionText) {
            $prompt .= ($index + 1) . ". Pertanyaan: {$questionText}\n";
            $prompt .= "   Jawaban: " . ($answers[$index] ?? "Tidak dijawab") . "\n";
        }
        $prompt .= "\nBerdasarkan jawaban di atas untuk kategori \"{$category->label}\", berikan analisis dan rekomendasi 2-3 jurusan yang paling relevan.\n";
        $prompt .= "Untuk setiap jurusan, berikan nama jurusan dan alasan mengapa cocok dengan singkat dan jelas.\n";
        $prompt .= "Format output harus dalam HTML dasar seperti contoh ini (fokus pada konten, AI akan menyesuaikan detail HTML):\n";
        $prompt .= "<strong>Analisis Rekomendasi Jurusan Berdasarkan {$category->label}</strong><br><br>\n";
        $prompt .= "<strong>1. [Nama Jurusan 1]</strong><br> &nbsp; &nbsp;Alasan: [Alasan yang detail dan relevan dengan jawaban siswa untuk kategori ini].<br><br>\n";
        $prompt .= "<strong>2. [Nama Jurusan 2]</strong><br> &nbsp; &nbsp;Alasan: [Alasan yang detail dan relevan].<br><br>\n";

        try {
            $model = config('services.openrouter.enabled')
                ? config('services.openrouter.model')
                : 'gpt-3.5-turbo';

            $chatResponse = $this->openaiClient->chat()->create([
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah konselor karir AI. Berikan jawaban dalam format HTML dasar yang diminta.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
                'max_tokens' => 1000,
            ]);

            $summaryHtml = $chatResponse->choices[0]->message->content;

            // Potong koin SETELAH berhasil mendapatkan respons AI
            $this->decrementUserCoins($user, $totalCost);

            // Simpan assessment ke database
            UserCategoryAssessment::create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'questions_data' => $questionsDataForStorage,
                'summary_text' => $summaryHtml,
                'cost_incurred' => $totalCost,
                'completed_at' => now(),
            ]);

            return response()->json([
                'summary' => $summaryHtml,
                'new_coin_balance' => $this->getUserCoins($user)
            ]);
        } catch (\Exception $e) {
            Log::error("OpenAI API Error (Category Summary): " . $e->getMessage());
            // Jangan decrement koin jika error
            return response()->json(['error' => 'Gagal menghasilkan summary dari AI. Silakan coba lagi nanti.', 'details' => $e->getMessage()], 500);
        }
    }

    public function getOverallSummary(Request $request)
    {
        $logIdentifier = (string) Str::uuid();
        $user = Auth::user();
        Log::info("[OverallSummary:START] [$logIdentifier] Request received from User ID: {$user->id}.");

        $allUserAnswersFromRequest = $request->input('allUserAnswers'); // Format: ['Category Label' => ['categoryIdKey' => 'slug', 'answers' => [...], 'questions' => [...]], ...]

        Log::debug("[OverallSummary:DATA_IN] [$logIdentifier] Raw 'allUserAnswers' data received:", [
            'data' => json_encode($allUserAnswersFromRequest, JSON_PRETTY_PRINT)
        ]);

        $overallSummaryCost = 5; // Biaya untuk summary keseluruhan
        $categoryCount = is_array($allUserAnswersFromRequest) ? count($allUserAnswersFromRequest) : 0;

        Log::info("[OverallSummary:VALIDATE_COUNT] [$logIdentifier] Validating category count. Found: {$categoryCount}, Required: >= 2.");

        if ($categoryCount < 2) {
            Log::warning("[OverallSummary:FAIL_COUNT] [$logIdentifier] Validation failed. User only completed {$categoryCount} categories. Aborting.");
            return response()->json(['error' => 'Anda perlu menjawab minimal dua kategori untuk mendapatkan summary keseluruhan.'], 400);
        }


        // Validasi 2: Koin pengguna
        $userCoins = $this->getUserCoins($user);
        Log::info("[OverallSummary:VALIDATE_COINS] [$logIdentifier] Validating user coins. Has: {$userCoins}, Required: {$overallSummaryCost}.");

        if ($userCoins < $overallSummaryCost) {
            Log::warning("[OverallSummary:FAIL_COINS] [$logIdentifier] Validation failed. Insufficient coins. Aborting.");
            return response()->json(['error' => 'Koin tidak cukup untuk summary keseluruhan.'], 402);
        }

        Log::info("[OverallSummary:BUILD_PROMPT] [$logIdentifier] All validations passed. Starting to build the prompt for AI.");

        $prompt = "Anda adalah AI konselor karir ahli. Berdasarkan data jawaban siswa berikut, berikan 2-3 rekomendasi jurusan.
JAWABAN ANDA HARUS BERUPA FORMAT JSON YANG VALID, BUKAN TEKS BIASA ATAU HTML.

Struktur JSON harus seperti ini:
{
  \"rekomendasi\": [
    {
      \"nama_jurusan\": \"(Nama Jurusan yang Direkomendasikan)\",
      \"alasan\": \"(Jelaskan secara komprehensif mengapa jurusan ini cocok, dengan menggabungkan analisis dari semua kategori. Gunakan tag <br> untuk baris baru jika perlu.)\",
      \"tingkat_kecocokan\": [
        {
          \"kategori\": \"(Nama Kategori 1, misal: Keinginan Orang Tua)\",
          \"persentase\": \"(Persentase, misal: 90%)\",
          \"detail_alasan\": \"(Alasan singkat untuk persentase di kategori ini.)\"
        },
        {
          \"kategori\": \"(Nama Kategori 2, misal: FINANCIAL)\",
          \"persentase\": \"(Persentase, misal: 80%)\",
          \"detail_alasan\": \"(Alasan singkat untuk persentase di kategori ini.)\"
        }
      ]
    }
  ]
}

Pastikan untuk mengisi semua field sesuai format. Berikut adalah data jawaban siswa:
\n";

        $contextDataForStorage = [];
        $processedCategoriesCount = 0;

        foreach ($allUserAnswersFromRequest as $categoryLabel => $answersData) {
            // Pastikan data yang masuk memiliki struktur yang diharapkan
            $slug = $answersData['categoryIdKey'] ?? null;
            if (!$slug) {
                Log::warning("[OverallSummary:PROCESS_LOOP] [$logIdentifier] Skipping an item because 'categoryIdKey' is missing.", ['item_label' => $categoryLabel]);
                continue;
            }

            $category = Category::where('slug', $slug)->first();

            if ($category && !empty($answersData['answers'])) {
                Log::info("[OverallSummary:PROCESS_LOOP] [$logIdentifier] Processing category: '{$category->label}' (Slug: {$slug}).");
                $processedCategoriesCount++;

                $prompt .= "Kategori: \"{$category->label}\"\n";
                $questionsForThisCategory = $answersData['questions'];
                foreach ($questionsForThisCategory as $index => $questionText) {
                    $prompt .= "- Pertanyaan: {$questionText}\n";
                    $prompt .= "  Jawaban: " . ($answersData['answers'][$index] ?? "Tidak dijawab") . "\n";
                }
                $prompt .= "\n";

                $contextDataForStorage[$category->slug] = [
                    'label' => $category->label,
                    'questions' => $questionsForThisCategory,
                    'answers' => $answersData['answers'],
                    'summary_from_category' => $answersData['summary'] ?? null
                ];
            } else {
                Log::warning("[OverallSummary:PROCESS_LOOP] [$logIdentifier] Could not find category for slug '{$slug}' or answers were empty. Skipping.");
            }
        }

        if ($processedCategoriesCount < 2) {
            Log::error("[OverallSummary:FAIL_PROCESS] [$logIdentifier] After processing, valid categories count ({$processedCategoriesCount}) is less than 2. Aborting.");
            return response()->json(['error' => 'Terjadi masalah saat memproses data kategori Anda. Pastikan data valid.'], 400);
        }

        $prompt .= "\nSekarang, hasilkan output JSON berdasarkan analisis data di atas. Pastikan JSON valid.";



        Log::debug("[OverallSummary:FINAL_PROMPT] [$logIdentifier] The final prompt is ready to be sent to AI.", ['prompt' => $prompt]);

        try {
            $model = config('services.openrouter.enabled')
                ? config('services.openrouter.model')
                : 'gpt-4o';

            Log::info("[OverallSummary:API_CALL] [$logIdentifier] Sending request to AI model: {$model}.");

            $chatResponse = $this->openaiClient->chat()->create([
                'model' => $model,
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah konselor karir AI yang menghasilkan output HANYA dalam format JSON yang diminta.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
                'max_tokens' => 2000,
            ]);
            $rawResponse = $chatResponse->choices[0]->message->content;
            Log::debug("[OverallSummary:API_RESPONSE] AI Raw Response:", ['raw' => $rawResponse]);

            // EKSTRAK BLOK JSON DARI RESPONS MENTAH MENGGUNAKAN REGEX
            $jsonString = null;
            if (preg_match('/\{[\s\S]*\}/', $rawResponse, $matches)) {
                $jsonString = $matches[0];
            }

            // JIKA TIDAK ADA BLOK JSON YANG DITEMUKAN, KEMBALIKAN ERROR
            if (!$jsonString) {
                Log::error("[OverallSummary:JSON_EXTRACTION_ERROR] Could not find a JSON block in the AI response.");
                return response()->json(['error' => 'Gagal mengekstrak data dari respons AI.'], 500);
            }

            // DECODE STRING JSON YANG SUDAH BERSIH
            $summaryData = json_decode($jsonString, true);

            // VALIDASI JIKA JSON DARI AI TIDAK VALID
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error("[OverallSummary:JSON_ERROR] Failed to decode JSON from AI.", ['error' => json_last_error_msg()]);
                // Berikan respons error atau coba parsing manual sebagai fallback
                return response()->json(['error' => 'Gagal memproses respons dari AI. Format tidak valid.'], 500);
            }

            Log::info("[OverallSummary:DECREMENT_COINS] ... ");
            $this->decrementUserCoins($user, $overallSummaryCost);

            Log::info("[OverallSummary:DB_SAVE] ... ");
            $overallSummary = UserOverallSummary::create([
                'user_id' => $user->id,
                // Simpan respons JSON mentah atau hasil yang sudah di-decode
                'summary_text' => json_encode($summaryData), // Simpan sebagai JSON di DB
                'context_data' => $contextDataForStorage,
                'cost_incurred' => $overallSummaryCost,
                'completed_at' => now(),
            ]);
            Log::info("[OverallSummary:DB_SUCCESS] Summary saved with ID: {$overallSummary->id}.");

            // KIRIM DATA TERSTRUKTUR KE FRONTEND
            $finalResponseData = [
                // 'summary' tidak lagi digunakan, ganti dengan 'recommendations'
                'recommendations' => $summaryData['rekomendasi'] ?? [], // Kirim array rekomendasi
                'overall_summary_id' => $overallSummary->id,
                'new_coin_balance' => $this->getUserCoins($user)
            ];

            Log::info("[OverallSummary:SUCCESS] Process completed successfully. Sending JSON response to frontend.");
            return response()->json($finalResponseData);
        } catch (\Exception $e) {
            // Log error dengan detail dan stack trace
            Log::error("[OverallSummary:EXCEPTION] [$logIdentifier] An exception occurred during AI API call or processing.", [
                'error_message' => $e->getMessage(),
                'exception' => $e // Ini akan mencetak stack trace lengkap di log
            ]);

            return response()->json(['error' => 'Gagal menghasilkan summary keseluruhan dari AI. Silakan coba lagi nanti.', 'details' => $e->getMessage()], 500);
        }
    }

    // GANTI FUNGSI LAMA DENGAN YANG INI
    public function startSimulation(Request $request)
    {
        $logIdentifier = (string) Str::uuid();
        $user = Auth::user();
        $selectedMajor = $request->input('selected_major');
        $overallSummaryId = $request->input('overall_summary_id');

        Log::info("[Simulation:START] [$logIdentifier] User ID: {$user->id}, Major: {$selectedMajor}");

        try {
            $overallSummary = UserOverallSummary::findOrFail($overallSummaryId);
            // Ambil ringkasan profil siswa dari summary sebelumnya sebagai konteks utama
            $userContext = json_encode($overallSummary->context_data);

            // =========================================================================
            // BARU: PROMPT YANG LEBIH KOMPREHENSIF UNTUK MERANCANG SELURUH CERITA
            // =========================================================================
            $prompt = "Anda adalah Perancang Skenario Interaktif dan Konselor Karir. Tugas Anda adalah membuat cerita simulasi singkat (3 langkah) yang relevan dan mendalam untuk seorang siswa yang mempertimbangkan jurusan '{$selectedMajor}'.

        PROFIL SISWA (berdasarkan jawaban assessment mereka sebelumnya):
        {$userContext}

        INSTRUKSI UTAMA:
        1.  **Buat Cerita Koheren:** Rancang sebuah narasi 3 langkah yang memiliki awal, tantangan inti di tengah, dan sebuah resolusi di akhir. Cerita harus mencerminkan satu aspek kunci atau proyek realistis yang mungkin dihadapi mahasiswa di jurusan '{$selectedMajor}'.
        2.  **Personalisasi Konten:** Gunakan 'PROFIL SISWA' di atas untuk membuat skenario yang relevan. Contoh: jika siswa menunjukkan minat pada 'analisis data', tantangan bisa berupa studi kasus. Jika minat pada 'kreativitas', tantangan bisa berupa tugas desain.
        3.  **Pilihan yang Bermakna:** Setiap pilihan yang Anda berikan harus merefleksikan pendekatan yang berbeda (misalnya: pendekatan analitis vs. kreatif, kolaboratif vs. individual).
        4.  **Format Output (WAJIB JSON):** Jawaban Anda HARUS berupa satu blok JSON tunggal yang berisi array dari 3 langkah. JANGAN memberikan teks pembuka atau penutup di luar JSON.

        Contoh Struktur JSON yang Diinginkan:
        ```json
        {
          \"title\": \"(Judul Singkat Simulasi, misal: 'Proyek Analisis Sentimen')\",
          \"story_arc\": [
            {
              \"step\": 1,
              \"scenario\": \"(Teks skenario awal yang menarik dan relevan dengan profil siswa dan jurusan. Ini adalah pengenalan masalah.)\",
              \"options\": [
                { \"value\": \"opsi_a\", \"text\": \"(Teks pilihan A yang jelas dan berbeda)\" },
                { \"value\": \"opsi_b\", \"text\": \"(Teks pilihan B yang jelas dan berbeda)\" }
              ]
            },
            {
              \"step\": 2,
              \"scenario\": \"(Teks skenario kedua yang merupakan pengembangan dari langkah 1. Ini adalah inti tantangan.)\",
              \"options\": [
                { \"value\": \"opsi_c\", \"text\": \"(Teks pilihan C)\" },
                { \"value\": \"opsi_d\", \"text\": \"(Teks pilihan D)\" }
              ]
            },
            {
              \"step\": 3,
              \"scenario\": \"(Teks skenario ketiga yang merupakan hasil atau konsekuensi dari pilihan di langkah 2. Ini adalah penutup cerita sebelum analisis akhir.)\",
              \"options\": [
                { \"value\": \"opsi_e\", \"text\": \"(Teks pilihan E)\" },
                { \"value\": \"opsi_f\", \"text\": \"(Teks pilihan F)\" }
              ]
            }
          ]
        }
        ```
        Pastikan untuk mengisi semua field sesuai format di atas.";

            // Panggil AI dengan prompt baru yang lebih canggih
            $rawResponse = $this->callOpenAI($prompt, 'Anda adalah AI yang menghasilkan output HANYA dalam format JSON yang diminta.');
            $jsonString = $this->extractJson($rawResponse);
            $simulationStory = json_decode($jsonString, true);

            // Validasi respons dari AI
            if (json_last_error() !== JSON_ERROR_NONE || !isset($simulationStory['story_arc']) || count($simulationStory['story_arc']) < 3) {
                Log::error("[Simulation:START_INVALID_STORY]", ['raw_response' => $rawResponse]);
                throw new \Exception('AI gagal merancang alur cerita yang valid.');
            }

            // Buat sesi baru dan SIMPAN SELURUH CERITA
            $session = SimulationSession::create([
                'user_id' => $user->id,
                'overall_summary_id' => $overallSummaryId,
                'selected_major' => $selectedMajor,
                'status' => 'started',
                'simulation_data' => $simulationStory['story_arc'] // DIUBAH: Simpan seluruh cerita
            ]);

            // Ambil langkah pertama dari cerita yang sudah disimpan
            $firstStep = $session->simulation_data[0];

            // Simpan skenario pertama ke histori
            $session->responses()->create([
                'step_number' => 1,
                'scenario_text' => $firstStep['scenario'],
                'user_choice_value' => 'start',
            ]);

            // Kirim hanya langkah pertama ke frontend
            return response()->json([
                'session_id' => $session->id,
                'current_step' => [
                    'id' => 'step_1',
                    'current_step_number' => 1,
                    'total_steps' => count($session->simulation_data),
                    'scenario_text' => $firstStep['scenario'],
                    'options' => $firstStep['options'],
                ]
            ]);
        } catch (\Exception $e) {
            Log::error("[Simulation:START_FAILED] [$logIdentifier]", ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Gagal mempersiapkan simulasi yang komprehensif. Silakan coba lagi.'], 500);
        }
    }

    // GANTI FUNGSI LAMA DENGAN YANG INI
    public function submitSimulationAnswer(Request $request)
    {
        $user = Auth::user();
        $sessionId = $request->input('session_id');
        $answerValue = $request->input('answer');

        try {
            $session = SimulationSession::where('id', $sessionId)->where('user_id', $user->id)->firstOrFail();
            if ($session->status === 'completed') {
                return response()->json(['error' => 'Sesi simulasi ini sudah selesai.'], 400);
            }

            // Ambil histori untuk mengetahui kita ada di langkah ke berapa
            $historyCount = $session->responses()->count();
            $currentStepNumber = $historyCount;

            // Update jawaban dari langkah sebelumnya
            $lastResponse = $session->responses()->where('step_number', $currentStepNumber)->first();
            if ($lastResponse) {
                $storyData = collect($session->simulation_data);
                $currentStepData = $storyData->firstWhere('step', $currentStepNumber);
                $chosenOptionText = collect($currentStepData['options'] ?? [])->firstWhere('value', $answerValue)['text'] ?? $answerValue;

                $lastResponse->update([
                    'user_choice_text' => $chosenOptionText,
                    'user_choice_value' => $answerValue
                ]);
            }

            // Cek apakah ini adalah langkah terakhir
            $totalSteps = count($session->simulation_data);
            if ($currentStepNumber >= $totalSteps) {
                // Jika ya, panggil fungsi untuk menyelesaikan simulasi dan berikan analisis akhir
                return $this->endSimulation($session);
            }

            // Jika bukan langkah terakhir, ambil langkah berikutnya dari data yang tersimpan
            $nextStepData = $session->simulation_data[$currentStepNumber]; // Array index starts from 0

            // Simpan skenario baru ke histori
            $session->responses()->create([
                'step_number' => $currentStepNumber + 1,
                'scenario_text' => $nextStepData['scenario'],
            ]);

            return response()->json([
                'session_id' => $sessionId,
                'current_step' => [
                    'id' => 'step_' . ($currentStepNumber + 1),
                    'current_step_number' => $currentStepNumber + 1,
                    'total_steps' => $totalSteps,
                    'scenario_text' => $nextStepData['scenario'],
                    'options' => $nextStepData['options'],
                ],
            ]);
        } catch (\Exception $e) {
            Log::error("[Simulation:SUBMIT_FAILED]", ['error' => $e->getMessage(), 'session_id' => $sessionId]);
            return response()->json(['error' => 'Gagal melanjutkan simulasi.'], 500);
        }
    }

    // Ganti fungsi endSimulation lama Anda dengan yang ini
    // GANTI FUNGSI LAMA DENGAN YANG INI
    protected function endSimulation(SimulationSession $session)
    {
        // Ambil profil awal pengguna dari summary yang terkait
        $overallSummary = UserOverallSummary::find($session->overall_summary_id);
        $userContext = $overallSummary ? json_encode($overallSummary->context_data) : 'Profil awal tidak tersedia.';

        // Ambil semua jejak jawaban dari DB untuk membangun histori
        $history = $session->responses()->orderBy('step_number')->get()->map(function ($resp) {
            if (!empty($resp->user_choice_text)) {
                return "Langkah {$resp->step_number}: Pada skenario '{$resp->scenario_text}', pengguna memilih '{$resp->user_choice_text}'.";
            }
            return null;
        })->filter()->implode("\n");

        // =========================================================================
        // BARU: PROMPT ANALISIS AKHIR YANG LEBIH HOLISTIK
        // =========================================================================
        $finalPrompt = "Anda adalah seorang konselor karir AI yang sangat bijaksana. Berikan analisis akhir yang mendalam dari simulasi jurusan yang telah diselesaikan siswa.

    Jurusan yang disimulasikan: '{$session->selected_major}'.

    KONTEKS 1: PROFIL AWAL SISWA (dari assessment)
    {$userContext}

    KONTEKS 2: JEJAK PILIHAN SISWA SELAMA SIMULASI
    {$history}

    INSTRUKSI ANALISIS:
    1.  **Hubungkan Dua Konteks:** Berikan analisis yang menghubungkan profil awal siswa dengan pilihan yang mereka buat selama simulasi.
    2.  **Struktur Jelas:** Gunakan struktur HTML yang diminta di bawah ini. JANGAN gunakan Markdown (seperti `**` atau `*`).
    3.  **Nada Positif dan Membangun:** Berikan feedback yang memberdayakan dan fokus pada pengembangan diri.

    Gunakan struktur HTML berikut:
    <h4>Analisis Akhir Simulasi</h4>
    <p>Berikut adalah analisis berdasarkan profil dan pilihan-pilihan yang kamu buat selama simulasi jurusan <strong>{$session->selected_major}</strong>.</p>
    
    <strong>Kekuatan yang Terkonfirmasi:</strong>
    <p>(Jelaskan kekuatan yang ditunjukkan siswa. Hubungkan dengan profil awal. Contoh: 'Profil awalmu menunjukkan ketertarikan pada pemecahan masalah, dan pilihanmu untuk [pilihan di simulasi] mengkonfirmasi kemampuanmu dalam menganalisis situasi secara logis.')</p>
    
    <strong>Potensi Area untuk Dikembangkan:</strong>
    <p>(Jelaskan potensi tantangan atau area pengembangan. Contoh: 'Kecenderunganmu untuk memilih [pilihan di simulasi] menunjukkan kamu lebih nyaman bekerja sendiri. Di dunia [nama jurusan], kemampuan kolaborasi sangat penting. Ini bisa menjadi area yang perlu kamu latih.')</p>
    
    <strong>Saran Pengembangan Lanjutan:</strong>
    <ul>
      <li>(Berikan saran pertama yang konkret dan relevan. Contoh: 'Cobalah untuk mengikuti proyek kelompok kecil pada semester awal untuk melatih kemampuan komunikasimu.')</li>
      <li>(Berikan saran kedua yang konkret dan relevan. Contoh: 'Untuk memperdalam pemahamanmu tentang [topik], kami sarankan membaca buku [judul buku] atau mengikuti kursus online di [platform].')</li>
    </ul>
    ";

        $finalOutcomeHtml = $this->callOpenAI($finalPrompt, "Anda adalah seorang konselor karir yang memberikan feedback akhir dalam format HTML.");

        $session->status = 'completed';
        $session->final_outcome = $finalOutcomeHtml;
        $session->save();

        return response()->json([
            'session_id' => $session->id,
            'current_step' => [
                'id' => 'final_summary',
                'is_final_step' => true,
                'scenario_text' => $finalOutcomeHtml,
                'options' => [],
            ]
        ]);
    }
}
