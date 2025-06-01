<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use OpenAI; // Namespace dari pustaka OpenAI yang diinstal

class AIChatbotController extends Controller
{
    protected $openaiClient;
    protected $categoriesData; // Data kategori dan pertanyaan

    public function __construct()
    {
        // Inisialisasi OpenAI Client
        // Pastikan konfigurasi 'services.openai.api_key' sudah benar
        $this->openaiClient = OpenAI::client(config('services.openai.api_key'));

        // Data kategori dan pertanyaan (bisa dari config, database, atau hardcode)
        // Saya akan menggunakan contoh struktur seperti yang Anda berikan
        $this->categoriesData = [
            'bakat_minat' => [
                'id' => 'bakat_minat', // ID unik untuk referensi
                'label' => 'Bakat & Minat',
                'questions' => [
                    "Hobi / aktivitas apa yang bikin kamu semangat melakukannya setiap hari?",
                    "Pelajaran sekolah apa yang paling kamu tunggu-tunggu di sekolah?",
                    "Soft skill apa yang kamu miliki?",
                    "Hard skill apa yang kamu miliki?"
                ],
                'cost_per_question' => 15,
            ],
            'keinginan_ortu' => [
                'id' => 'keinginan_ortu',
                'label' => 'Keinginan Orang Tua',
                'questions' => [
                    "Orang tua ingin kamu bekerja di bidang apa?",
                    "Aspek apa dari jurusan yang orang tuamu harapkan bisa ditemukan di jurusan pilihan?",
                    "Apakah ada kriteria minimum yang orang tua harapkan jika kamu memilih jurusan di luar harapan mereka? Misalnya: akreditasi, reputasi universitas, prospek kerja"
                ],
                'cost_per_question' => 15,
            ],
            'financial' => [
                'id' => 'financial',
                'label' => 'FINANCIAL',
                'questions' => [
                    "Bagaimana Anda merencanakan pengelolaan keuangan Anda dalam jangka panjang setelah lulus kuliah?",
                    "Sejauh mana Anda memahami konsep keuangan pribadi dan investasi dalam menentukan pilihan jurusan Anda?",
                    "Kamu berencana kuliah di kota besar atau dekat rumah?",
                    "Apakah orang tuamu sudah menyiapkan dana kuliah atau kamu harus mandiri?",
                    // Tambahkan pertanyaan lain jika ada
                ],
                'cost_per_question' => 15, // Atau sesuaikan biayanya
            ],
            'prospek_karir' => [
                'id' => 'prospek_karir',
                'label' => 'PROSPEK KARIR',
                'questions' => [
                    "Apa tantangan terbesar dalam mengembangkan karir profesional Anda?",
                    "Menurut Anda lebih penting dalam memilih karir yg memiliki potensi penghasilan besar atau peluang untuk berkembang dalam bidang yang diminati?",
                    "Bagaimana Anda melihat prospek karir di bidang yang Anda pilih dalam lima tahun ke depan?"
                ],
                'cost_per_question' => 15,
            ],
            // Tambahkan kategori lain di sini (Nilai dan Prinsip Hidup, Gaya Belajar, Tipe Kecerdasan, Kepribadian)
            // Pastikan 'id' unik dan 'label' sesuai dengan yang digunakan di frontend
        ];
    }

    public function index()
    {
        $user = Auth::user();
        return view('chatbot', [ // Ganti 'your-blade-view-name' dengan nama file Blade Anda
            'categories' => $this->categoriesData,
            'userCoins' => $user->coins,
            // Kirim juga userAnswers yang sudah tersimpan jika Anda ingin ada state persistence
            // 'userAnswers' => session('userAnswers', [])
        ]);
    }

    public function getCategorySummary(Request $request)
    {
        $user = Auth::user();
        $categoryId = $request->input('categoryId'); // Misal: 'bakat_minat'
        $numQuestionsSelected = (int)$request->input('numQuestions'); // Jumlah pertanyaan yang dipilih user
        $answers = $request->input('answers'); // Array jawaban dari user

        if (!isset($this->categoriesData[$categoryId])) {
            return response()->json(['error' => 'Kategori tidak valid.'], 400);
        }

        $categoryDetails = $this->categoriesData[$categoryId];
        $costPerQuestion = $categoryDetails['cost_per_question'] ?? 15; // Default cost
        $totalCost = $numQuestionsSelected * $costPerQuestion;

        if ($user->coins < $totalCost) {
            return response()->json(['error' => 'Koin tidak cukup untuk ' . $numQuestionsSelected . ' pertanyaan di kategori ini.'], 402); // Payment Required
        }

        // Potong koin
        $user->decrement('coins', $totalCost);
        // session()->put("userAnswers.{$categoryDetails['label']}", $answers); // Simpan jawaban di session jika perlu

        // Ambil pertanyaan yang sesuai dengan jumlah yang dipilih
        $questionsForPrompt = array_slice($categoryDetails['questions'], 0, $numQuestionsSelected);

        // Membuat Prompt untuk OpenAI
        $prompt = "Anda adalah seorang AI konselor karir yang membantu siswa menemukan rekomendasi jurusan kuliah.\n";
        $prompt .= "Kategori saat ini adalah: \"{$categoryDetails['label']}\".\n";
        $prompt .= "Siswa telah menjawab {$numQuestionsSelected} pertanyaan berikut:\n";
        foreach ($questionsForPrompt as $index => $questionText) {
            $prompt .= ($index + 1) . ". Pertanyaan: {$questionText}\n";
            $prompt .= "   Jawaban: " . ($answers[$index] ?? "Tidak dijawab") . "\n";
        }
        $prompt .= "\nBerdasarkan jawaban di atas untuk kategori \"{$categoryDetails['label']}\", berikan analisis dan rekomendasi 3-5 jurusan yang relevan.\n";
        $prompt .= "Untuk setiap jurusan, berikan nama jurusan dan alasan mengapa itu cocok.\n";
        $prompt .= "Format output harus dalam HTML dasar seperti contoh ini (fokus pada konten, AI akan menyesuaikan detail HTML):\n";
        $prompt .= "<strong>Analisis Rekomendasi Jurusan Berdasarkan {$categoryDetails['label']}</strong><br><br>\n";
        $prompt .= "<strong>JURUSAN YANG MUNGKIN SESUAI BUAT KAMU:</strong><br><br>\n";
        $prompt .= "<strong>1. [Nama Jurusan 1]</strong><br> &nbsp; &nbsp;Alasan: [Alasan yang detail dan relevan dengan jawaban siswa untuk kategori ini].<br><br>\n";
        $prompt .= "<strong>2. [Nama Jurusan 2]</strong><br> &nbsp; &nbsp;Alasan: [Alasan yang detail dan relevan].<br><br>\n";
        // Anda bisa menambahkan lebih banyak contoh format jika perlu

        try {
            $chatResponse = $this->openaiClient->chat()->create([
                'model' => 'gpt-3.5-turbo', // Atau model lain yang sesuai
                'messages' => [
                    ['role' => 'system', 'content' => 'Anda adalah konselor karir AI. Berikan jawaban dalam format HTML dasar yang diminta.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7, // Sesuaikan untuk keseimbangan kreativitas dan presisi
                'max_tokens' => 1000, // Perkirakan panjang output
            ]);

            $summaryHtml = $chatResponse->choices[0]->message->content;

            return response()->json([
                'summary' => $summaryHtml,
                'new_coin_balance' => $user->fresh()->coins // Ambil saldo koin terbaru
            ]);
        } catch (\Exception $e) {
            Log::error("OpenAI API Error (Category Summary): " . $e->getMessage());
            // Kembalikan koin jika ada error dari API
            $user->increment('coins', $totalCost);
            return response()->json(['error' => 'Gagal menghasilkan summary dari AI. Silakan coba lagi nanti.', 'details' => $e->getMessage()], 500);
        }
    }
    public function getOverallSummary(Request $request)
{
    $user = Auth::user();
    // $allUserAnswers adalah array asosiatif: ['Nama Kategori 1' => ['jawaban1', 'jawaban2'], 'Nama Kategori 2' => [...]]
    $allUserAnswers = $request->input('allUserAnswers'); // Dapatkan semua jawaban dari frontend

    $overallSummaryCost = 5; // Biaya untuk summary keseluruhan

    if (count($allUserAnswers) < 2) { // Pastikan minimal ada 2 kategori yang dijawab
        return response()->json(['error' => 'Anda perlu menjawab minimal dua kategori untuk mendapatkan summary keseluruhan.'], 400);
    }

    if ($user->coins < $overallSummaryCost) {
        return response()->json(['error' => 'Koin tidak cukup untuk summary keseluruhan.'], 402);
    }

    // Potong koin
    $user->decrement('coins', $overallSummaryCost);

    // Membuat Prompt untuk OpenAI (ini akan lebih kompleks)
    $prompt = "Anda adalah AI konselor karir ahli yang memberikan rekomendasi jurusan kuliah terpadu.\n";
    $prompt .= "Berikut adalah jawaban siswa dari berbagai kategori yang telah diisi:\n\n";

    foreach ($allUserAnswers as $categoryLabel => $answersData) {
        // Cari detail kategori (termasuk pertanyaan asli) berdasarkan label
        $categoryKeyFound = null;
        foreach ($this->categoriesData as $key => $catDetails) {
            if ($catDetails['label'] === $categoryLabel) {
                $categoryKeyFound = $key;
                break;
            }
        }

        if ($categoryKeyFound && !empty($answersData['answers'])) {
            $prompt .= "Kategori: \"{$categoryLabel}\"\n";
            $questionsForThisCategory = array_slice($this->categoriesData[$categoryKeyFound]['questions'], 0, count($answersData['answers']));
            foreach ($questionsForThisCategory as $index => $questionText) {
                $prompt .= "- Pertanyaan: {$questionText}\n";
                $prompt .= "  Jawaban: " . ($answersData['answers'][$index] ?? "Tidak dijawab") . "\n";
            }
            $prompt .= "\n";
        }
    }

    $prompt .= "Berdasarkan SEMUA informasi di atas dari berbagai kategori, berikan rekomendasi 2-3 jurusan yang paling sesuai secara keseluruhan.\n";
    $prompt .= "Untuk setiap jurusan yang direkomendasikan, berikan:\n";
    $prompt .= "1. NAMA JURUSAN (bisa spesifik, misal 'Desain Komunikasi Visual (DKV) dengan fokus UI/UX').\n";
    $prompt .= "2. ALASAN REASONING: Jelaskan secara komprehensif mengapa jurusan ini cocok, dengan MENGGABUNGKAN dan MENGANALISIS informasi dari berbagai kategori yang telah dijawab siswa.\n";
    $prompt .= "3. TINGKAT KECOCOKAN (dalam persentase perkiraan, misal 70-90%) dan alasan singkat untuk setiap kategori utama yang relevan (misalnya, Bakat & Minat: X%, Keinginan Orang Tua: Y%).\n";
    $prompt .= "4. Kesimpulan singkat dan saran akhir untuk siswa.\n";
    $prompt .= "Format output harus dalam HTML dasar seperti contoh yang diberikan (lihat contoh di JavaScript `updateOverallSummary` yang diberikan user sebelumnya, AI akan menyesuaikan).\n";
    $prompt .= "Contoh awal format:\n";
    $prompt .= "<strong>Baik, setelah mempertimbangkan informasi yang kamu berikan...</strong><br><br><strong>JURUSAN YANG DIREKOMENDASIKAN:</strong><br><br>* <strong>[Nama Jurusan 1]</strong><br>* <strong>[Nama Jurusan 2]</strong><br><br><strong>PER JURUSAN:</strong><br><br><strong>[Nama Jurusan 1]</strong><br><strong>ALASAN REASONING:</strong> [Penjelasan gabungan]...<br><strong>TINGKAT KECOCOKAN:</strong><br><strong>Kategori A:</strong> XX%<br>Alasan: ...<br><strong>Kategori B:</strong> YY%<br>Alasan: ...<br><br> (dan seterusnya untuk jurusan lain).";


    try {
        $chatResponse = $this->openaiClient->chat()->create([
            'model' => 'gpt-4o', // Atau gpt-3.5-turbo, tapi gpt-4 series mungkin lebih baik untuk tugas kompleks
            'messages' => [
                ['role' => 'system', 'content' => 'Anda adalah konselor karir AI ahli. Berikan rekomendasi jurusan terpadu dalam format HTML dasar yang diminta.'],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
            'max_tokens' => 2000, // Summary keseluruhan mungkin lebih panjang
        ]);

        $overallSummaryHtml = $chatResponse->choices[0]->message->content;

        return response()->json([
            'summary' => $overallSummaryHtml,
            'new_coin_balance' => $user->fresh()->coins
        ]);

    } catch (\Exception $e) {
        Log::error("OpenAI API Error (Overall Summary): " . $e->getMessage());
        $user->increment('coins', $overallSummaryCost); // Kembalikan koin
        return response()->json(['error' => 'Gagal menghasilkan summary keseluruhan dari AI. Silakan coba lagi nanti.', 'details' => $e->getMessage()], 500);
    }
}
}
