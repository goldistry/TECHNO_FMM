@extends('layout') {{-- Sesuaikan jika nama layout Anda berbeda --}}

@section('content')
    <style>
        /* Styling dari contoh awal Anda - bisa dipindahkan ke file CSS terpisah */
        #question-console {
            max-height: 450px;
            /* Sedikit lebih tinggi untuk summary */
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .chatbot-message {
            padding: 8px 12px;
            margin-bottom: 8px;
            border-radius: 12px;
            /* Lebih rounded */
            max-width: 80%;
            word-wrap: break-word;
        }

        .user-message {
            background-color: #edf2f7;
            /* Tailwind gray-200 */
            color: #2d3748;
            /* Tailwind gray-800 */
            align-self: flex-end;
            margin-left: auto;
            /* Dorong ke kanan */
        }

        .bot-message {
            background-color: #a8c778;
            color: white;
            font-weight: normal;
            /* Normal weight untuk pertanyaan, bold untuk judul summary */
            align-self: flex-start;
            margin-right: auto;
            /* Dorong ke kiri */
        }

        .bot-message.summary-title {
            font-weight: bold;
        }

        .bot-message.loading-message,
        .bot-message.error-message {
            font-style: italic;
        }

        .bot-message.error-message {
            background-color: #fed7d7;
            /* Tailwind red-200 */
            color: #c53030;
            /* Tailwind red-700 */
        }

        .input-area {
            display: flex;
            gap: 8px;
            margin-top: 16px;
            padding-top: 10px;
            /* Beri jarak dari chat history */
            border-top: 1px solid #e2e8f0;
            /* Garis pemisah tipis */
        }

        .input-area input[type="text"] {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #cbd5e0;
            /* Tailwind gray-300 */
            border-radius: 8px;
            color: #2d3748;
            /* Warna teks input agar kontras */
        }

        .input-area input[type="text"]::placeholder {
            color: #a0aec0;
            /* Tailwind gray-500 */
        }

        .input-area button {
            padding: 10px 16px;
            background-color: #fd7205;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .input-area button:hover {
            background-color: #e95e00;
            /* Warna hover lebih gelap */
        }

        .input-area button:disabled {
            background-color: #fbd38d;
            /* Tailwind orange-300 */
            cursor: not-allowed;
        }


        .header-ai {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }

        .header-ai img {
            display: block;
        }

        .welcome-bubble {
            position: absolute;
            top: 10px;
            left: calc(100% + 15px);
            /* Posisi bubble dari logo AI */
            background-color: #a8c778;
            min-width: 280px;
            /* Lebar minimum agar teks cukup */
            max-width: 400px;
            /* Lebar maksimum */
            color: white;
            padding: 10px 15px;
            border-radius: 15px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 0.95rem;
            /* Sesuaikan ukuran font bubble */
            line-height: 1.4;
        }

        .typed-cursor {
            opacity: 1;
            animation: blink 0.7s infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        .category-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            /* Tailwind shadow-md */
            padding: 20px;
            cursor: pointer;
            transition: box-shadow 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .category-card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            /* Tailwind shadow-lg */
            transform: translateY(-3px);
        }

        .category-card h2 {
            font-size: 1.25rem;
            /* text-xl */
            font-weight: 600;
            /* semibold */
            color: #fd7205;
            margin-bottom: 8px;
        }

        .category-card p {
            color: #718096;
            /* gray-600 */
            font-size: 0.875rem;
            /* text-sm */
        }

        #category-selection-modal,
        #overall-summary-modal {
            /* Menggunakan modal agar lebih fokus */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 20px;
        }

        .modal-content {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            /* Lebar maksimum modal */
        }

        .modal-content h2 {
            font-size: 1.5rem;
            /* text-2xl */
            font-weight: 600;
            /* semibold */
            color: #4a5568;
            /* gray-700 */
            margin-bottom: 16px;
        }

        .question-option-button {
            background-color: #a8c778;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .question-option-button:hover {
            background-color: #7f9c53;
        }

        .question-option-button:disabled {
            background-color: #cbd5e0;
            /* gray-300 */
            color: #a0aec0;
            /* gray-500 */
            cursor: not-allowed;
        }

        .question-option-button img {
            width: 20px;
            height: auto;
        }

        .modal-close-button {
            background-color: #e2e8f0;
            /* gray-300 */
            color: #4a5568;
            /* gray-700 */
            font-weight: 600;
            padding: 8px 16px;
            border-radius: 6px;
            margin-top: 20px;
            border: none;
            cursor: pointer;
        }

        .modal-close-button:hover {
            background-color: #cbd5e0;
            /* gray-400 */
        }

        .user-info {
            text-align: right;
            margin-bottom: 20px;
            font-size: 1rem;
            color: #4A5568;
            /* gray-700 */
        }

        .user-info strong {
            color: #2D3748;
            /* gray-800 */
        }

        .user-info img {
            width: 20px;
            height: auto;
            vertical-align: middle;
            margin-left: 5px;
        }

        #overall-summary-content {
            /* Untuk styling konten summary keseluruhan */
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 10px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .spinner {
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            width: 16px;
            height: 16px;
            animation: spin 1s ease-in-out infinite;
            display: inline-block;
            margin-left: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .summary-per-kategori-button {
            background-color: #ecc94b;
            /* Tailwind yellow-500 */
            color: #2d3748;
        }

        .summary-per-kategori-button:hover {
            background-color: #d69e2e;
            /* Tailwind yellow-600 */
        }
    </style>

    <div class="container min-h-[80vh] mx-auto p-4 md:p-8 bg-[#f8f1e5] mt-12 rounded-lg shadow-xl">
        <div class="header-ai">
            <img src="{{ asset('logoAI/AI.png') }}" alt="AI Mate Logo" style="width: 130px; height: auto;">
            <div class="welcome-bubble text-base"><span id="typed-welcome"></span></div>
        </div>

        <div class="user-info">
            Halo, <strong>{{ Auth::user()->name ?? 'Pengguna' }}</strong>!
            Koin Anda: <strong id="user-coin-balance">{{ $userCoins }}</strong>
            <img src="{{ asset('logoAI/coin.png') }}" alt="Koin">
        </div>

        <h1 class="text-4xl md:text-5xl font-bold text-center text-[#fd7205] mb-8">AI <span
                class="text-[#7f9c53]">MATE</span></h1>
        <p class="text-center text-gray-600 mb-10 text-lg">Pilih kategori di bawah untuk menemukan jurusan yang paling cocok
            untukmu!</p>

        {{-- Daftar Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse ($categories as $categoryId => $category)
                <div class="category-card"
                    onclick="showCategorySelection({{ Illuminate\Support\Js::from($categoryId) }}, {{ Illuminate\Support\Js::from($category['label']) }}, {{ count($category['questions']) }}, {{ $category['cost_per_question'] ?? 15 }})">
                    <h2>{{ $category['label'] }}</h2>
                    <p>{{ count($category['questions']) }} Pertanyaan</p>
                </div>
            @empty
                <p class="text-center col-span-full text-gray-500">Tidak ada kategori tersedia saat ini.</p>
            @endforelse
        </div>

        {{-- Modal Pemilihan Jumlah Pertanyaan --}}
        <div id="category-selection-modal" class="hidden">
            <div class="modal-content">
                <h2 id="selection-title">Pilih Jumlah Pertanyaan</h2>
                <div id="question-options-container" class="grid gap-3 grid-cols-2 md:grid-cols-2">
                    {{-- Opsi akan dimasukkan oleh JavaScript --}}
                </div>
                <button onclick="hideCategorySelection()" class="modal-close-button">Kembali</button>
            </div>
        </div>

        {{-- Konsol Pertanyaan (Chatbox) --}}
        <div id="question-console" class="bg-[#f0f4f8] p-4 rounded-lg mb-6 shadow-inner hidden"> {{-- Warna latar chatbox diubah agar kontras --}}
            <h2 id="console-title" class="text-2xl font-semibold text-[#2d3748] mb-4 text-center"></h2>
            <div id="chat-history" class="flex-grow overflow-y-auto mb-4 p-2 space-y-3">
                {{-- Riwayat chat akan muncul di sini --}}
            </div>
            <div class="input-area">
                <input type="text" id="user-input" placeholder="Ketik jawabanmu di sini..." autocomplete="off">
                <button id="send-button" onclick="processUserInput()">Kirim</button>
            </div>
            <button onclick="hideQuestionConsole()" class="modal-close-button w-full mt-4">Tutup Konsol Kategori</button>
        </div>

        {{-- Tombol & Area Summary Keseluruhan --}}
        <div class="flex w-full flex-col items-center justify-center mt-10">
            <button id="request-overall-summary-button" onclick="requestOverallSummary()"
                class="bg-[#ff933c] hover:bg-[#a8c778] text-white font-bold py-3 px-8 rounded-full focus:outline-none min-w-[280px] flex flex-col items-center justify-center text-lg shadow-lg transition-transform transform hover:scale-105">
                <span class="mb-1">Lihat Rekomendasi Jurusan Final</span>
                <div class="flex items-center gap-2 text-sm">
                    <img src="{{ asset('logoAI/coin.png') }}" alt="koin" class="w-5 h-auto">
                    <span>5 Koin</span> {{-- Biaya summary keseluruhan --}}
                </div>
            </button>
            <div id="overall-summary-content" class="mt-6 w-full max-w-3xl hidden">
                <h2 class="text-2xl font-semibold text-[#fd7205] mb-4 text-center">Rekomendasi Jurusan Final Untukmu</h2>
                <div id="overall-summary-text" class="text-gray-700 leading-relaxed">
                    {{-- Summary keseluruhan akan muncul di sini --}}
                </div>
                <button onclick="hideOverallSummaryContainer()" class="modal-close-button w-full mt-4">Tutup Rekomendasi
                    Final</button>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        // Data dari Backend (Global)
        const categoriesData = @json($categories);
        let currentUserCoins = {{ $userCoins }};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // State Aplikasi (Global)
        let currentCategoryId = null;
        let currentCategoryLabel = '';
        let currentCategoryQuestions = [];
        let questionsToAsk = [];
        let currentQuestionIndex = 0;
        let userAnswersForCurrentCategory = [];
        let allUserAnswers = {};

        // Elemen DOM (Deklarasikan Global, Isi di DOMContentLoaded)
        let coinBalanceElement, categorySelectionModal, selectionTitleElement, questionOptionsContainer,
            questionConsoleElement, consoleTitleElement, chatHistoryElement, userInputElement,
            sendButton, overallSummaryContentElement, overallSummaryTextElement, requestOverallSummaryButton;

        // --- FUNGSI HELPER DAN INTERAKTIF (GLOBAL SCOPE) ---

        function updateCoinBalanceUI(newBalance) {
            console.log("Updating coin balance UI to:", newBalance);
            currentUserCoins = newBalance;
            if (coinBalanceElement) {
                coinBalanceElement.textContent = currentUserCoins;
            } else {
                console.warn("coinBalanceElement not found when trying to update UI.");
            }
        }

        function displayMessageInChat(message, type, isHTML = false) {
            if (!chatHistoryElement) {
                // console.warn("chatHistoryElement not found for displayMessageInChat. Message:", message);
                return;
            }
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('chatbot-message', type === 'user' ? 'user-message' : 'bot-message');
            if (isHTML) {
                messageDiv.innerHTML = message;
            } else {
                messageDiv.textContent = message;
            }
            chatHistoryElement.appendChild(messageDiv);
            chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
        }

        function displayLoadingMessage(text = "Sedang memproses...") {
            const loadingId = 'loading-' + Date.now();
            displayMessageInChat(`<span id="${loadingId}">${text} <span class="spinner"></span></span>`, 'bot', true);
            return loadingId;
        }

        function removeLoadingMessage(loadingId) {
            const el = document.getElementById(loadingId);
            if (el && el.parentElement) {
                if (el.parentElement.classList.contains('bot-message')) {
                    el.parentElement.remove();
                } else {
                    el.remove();
                }
            }
        }

        function displayErrorMessageInChat(message) {
            displayMessageInChat(`<strong>Error:</strong> ${message}`, 'bot error-message', true);
        }

        function showCategorySelection(categoryId, categoryLabel, totalQuestions, costPerQuestion) {
            console.log("--- showCategorySelection CALLED ---");
            console.log("Args:", {
                categoryId,
                categoryLabel,
                totalQuestions,
                costPerQuestion
            });
            console.log("Current categoriesData:", JSON.parse(JSON.stringify(categoriesData))); // Log a copy
            console.log("Current currentUserCoins:", currentUserCoins);

            // Pastikan elemen DOM sudah diinisialisasi (seharusnya sudah via DOMContentLoaded)
            if (!selectionTitleElement || !questionOptionsContainer || !categorySelectionModal) {
                console.error(
                    "CRITICAL: Modal DOM elements (selectionTitleElement, questionOptionsContainer, or categorySelectionModal) not found!"
                );
                alert("Terjadi kesalahan internal: Komponen modal tidak siap. Silakan refresh halaman.");
                return;
            }
            console.log("Modal elements seem to be found.");

            currentCategoryId = categoryId;
            currentCategoryLabel = categoryLabel;

            if (!categoriesData || !categoriesData[categoryId] || typeof categoriesData[categoryId].questions ===
                'undefined') {
                console.error("ERROR: Category data is invalid, or 'questions' array is missing for categoryId:",
                    categoryId);
                console.log("Details of categoriesData[categoryId]:", categoriesData ? categoriesData[categoryId] :
                    'categoriesData is null/undefined');
                selectionTitleElement.textContent = `Error Data Kategori`;
                questionOptionsContainer.innerHTML =
                    '<p class="text-red-500 text-center col-span-full">Maaf, data pertanyaan untuk kategori ini tidak dapat dimuat.</p>';
                categorySelectionModal.classList.remove('hidden');
                return;
            }
            currentCategoryQuestions = categoriesData[categoryId].questions; // Simpan semua pertanyaan asli
            console.log("Original questions for this category:", currentCategoryQuestions);


            selectionTitleElement.textContent = `Pilih Jumlah Pertanyaan untuk "${categoryLabel}"`;
            questionOptionsContainer.innerHTML = ''; // Kosongkan opsi sebelumnya
            console.log("Cleared questionOptionsContainer.");

            // totalQuestions harusnya dari count($category['questions']) di Blade, pastikan itu angka
            totalQuestions = Number(totalQuestions);
            costPerQuestion = Number(costPerQuestion || 15); // Default cost if undefined

            console.log("Processed totalQuestions:", totalQuestions, "Processed costPerQuestion:", costPerQuestion);

            if (isNaN(totalQuestions) || totalQuestions < 0) {
                console.error("Invalid totalQuestions value:", totalQuestions);
                questionOptionsContainer.innerHTML =
                    '<p class="text-center text-gray-500 col-span-full">Jumlah pertanyaan tidak valid.</p>';
            } else if (totalQuestions === 0) {
                console.log("No questions available (totalQuestions is 0).");
                questionOptionsContainer.innerHTML =
                    '<p class="text-center text-gray-500 col-span-full">Tidak ada pertanyaan untuk kategori ini.</p>';
            } else {
                const minQuestions = Math.max(1, Math.min(2, totalQuestions));
                console.log("Calculated minQuestions:", minQuestions);

                let buttonsHtml = '';
                for (let i = minQuestions; i <= totalQuestions; i++) {
                    console.log("Looping to create button for 'i':", i);
                    const cost = i * costPerQuestion;
                    let disabledAttr = '';
                    let disabledText = '';
                    if (currentUserCoins < cost) {
                        disabledAttr = 'disabled title="Koin tidak cukup"';
                        disabledText =
                            ' <small style="display:block; font-size:0.7rem; color:var(--red-500)">(Koin tdk cukup)</small>'; // Ganti warna jika perlu
                    }
                    // Simpan parameter fungsi startQuestionConsole ke data- attributes
                    buttonsHtml += `
                    <button class="question-option-button" 
                            data-questions="${i}" 
                            data-cost="${cost}"
                            ${disabledAttr}>
                        ${i} Pertanyaan
                        <img src="{{ asset('logoAI/coin.png') }}" alt="koin" style="width:20px; height:auto;">
                        <span>${cost} Koin</span>
                        ${disabledText}
                    </button>
                `;
                }
                questionOptionsContainer.innerHTML = buttonsHtml;
                console.log("Generated buttons HTML:", buttonsHtml);

                // Tambahkan event listener ke tombol yang baru dibuat
                questionOptionsContainer.querySelectorAll('.question-option-button').forEach(button => {
                    if (button.disabled) return; // Jangan tambahkan listener ke tombol disabled
                    button.addEventListener('click', function() {
                        const numQ = parseInt(this.dataset.questions);
                        const cost = parseInt(this.dataset.cost);
                        console.log("Question option button clicked for", numQ, "questions. Cost:", cost);
                        if (currentUserCoins >= cost) {
                            startQuestionConsole(numQ, cost);
                        } else {
                            alert(`Koin Anda (${currentUserCoins}) tidak cukup. Butuh ${cost} koin.`);
                        }
                    });
                });


                if (questionOptionsContainer.childElementCount === 0 && totalQuestions > 0) {
                    console.warn(
                        "Loop for buttons ran, but no buttons were added. Check minQuestions and totalQuestions logic.");
                    questionOptionsContainer.innerHTML =
                        '<p class="text-center text-gray-500 col-span-full">Tidak ada opsi jumlah pertanyaan yang valid saat ini.</p>';
                }
            }
            categorySelectionModal.classList.remove('hidden');
            console.log("Modal should be visible. Number of buttons in container:", questionOptionsContainer
                .childElementCount);
            console.log("--- showCategorySelection END ---");
        }

        function hideCategorySelection() {
            console.log("--- hideCategorySelection CALLED ---");
            const modal = document.getElementById('category-selection-modal');
            if (modal) {
                modal.classList.add('hidden');
                console.log("Modal 'hidden' class ADDED.");
            } else {
                console.error("CRITICAL: categorySelectionModal element not found for hideCategorySelection!");
                alert("Error: Komponen modal tidak bisa ditutup.");
            }
            console.log("--- hideCategorySelection END ---");
        }

        // Pastikan modal tidak muncul saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('category-selection-modal');
            if (modal) {
                modal.classList.add('hidden');
            }
        });

        // ... (sisa fungsi Anda: startQuestionConsole, displayNextQuestion, processUserInput, dll. tetap sama seperti sebelumnya)
        // Pastikan fungsi-fungsi ini juga di luar DOMContentLoaded
        function startQuestionConsole(numQuestionsToAsk, cost) {
            console.log("startQuestionConsole called with:", numQuestionsToAsk, cost);
            if (currentUserCoins < cost) {
                alert("Koin tidak cukup.");
                return;
            }
            hideCategorySelection();
            if (consoleTitleElement) consoleTitleElement.textContent = `Kategori: ${currentCategoryLabel}`;
            if (chatHistoryElement) chatHistoryElement.innerHTML = '';
            userAnswersForCurrentCategory = [];
            currentQuestionIndex = 0;
            questionsToAsk = currentCategoryQuestions.slice(0, numQuestionsToAsk);
            console.log("Questions to ask:", questionsToAsk);
            if (questionConsoleElement) questionConsoleElement.classList.remove('hidden');
            if (userInputElement) {
                userInputElement.disabled = false;
                userInputElement.value = '';
                userInputElement.focus();
            }
            if (sendButton) sendButton.disabled = false;
            displayNextQuestion();
        }

        function displayNextQuestion() {
            console.log("displayNextQuestion called. Current index:", currentQuestionIndex, "Total to ask:", questionsToAsk
                .length);
            if (!userInputElement || !sendButton || !chatHistoryElement) {
                console.error("Chat console elements not ready for displayNextQuestion.");
                return;
            }
            if (currentQuestionIndex < questionsToAsk.length) {
                displayMessageInChat(questionsToAsk[currentQuestionIndex], 'bot');
            } else {
                console.log("All questions answered for this category.");
                userInputElement.disabled = true;
                sendButton.disabled = true;
                displayMessageInChat(
                    "Semua pertanyaan untuk kategori ini telah selesai. Klik tombol di bawah untuk melihat summary.",
                    'bot summary-title');
                const summaryButton = document.createElement('button');
                summaryButton.textContent = 'Lihat Summary Kategori Ini';
                summaryButton.className =
                    'chatbot-message bot-message summary-per-kategori-button self-center mt-4 py-2 px-4 rounded-lg cursor-pointer';
                summaryButton.onclick = () => {
                    console.log("Category summary button clicked.");
                    requestCategorySummary();
                    summaryButton.remove();
                };
                chatHistoryElement.appendChild(summaryButton);
                chatHistoryElement.scrollTop = chatHistoryElement.scrollHeight;
            }
        }

        function processUserInput() {
            console.log("processUserInput called.");
            if (!userInputElement) {
                console.error("userInputElement not found for processUserInput.");
                return;
            }
            const answer = userInputElement.value.trim();
            if (answer && !userInputElement.disabled) {
                displayMessageInChat(answer, 'user');
                userAnswersForCurrentCategory.push(answer);
                userInputElement.value = '';
                currentQuestionIndex++;
                displayNextQuestion();
            }
        }

        function hideQuestionConsole() {
            console.log("hideQuestionConsole called.");
            if (questionConsoleElement) questionConsoleElement.classList.add('hidden');
        }

        async function requestCategorySummary() {
            console.log("requestCategorySummary called for category:", currentCategoryLabel);
            const loadingId = displayLoadingMessage(`Memproses summary untuk "${currentCategoryLabel}"...`);
            try {
                const response = await fetch("{{ route('ai.mate.categorySummary') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        categoryId: currentCategoryId,
                        numQuestions: userAnswersForCurrentCategory.length,
                        answers: userAnswersForCurrentCategory
                    })
                });
                removeLoadingMessage(loadingId);
                const data = await response.json();
                console.log("Category summary response data:", data);
                if (!response.ok) {
                    displayErrorMessageInChat(data.error || `Gagal mendapatkan summary (Status: ${response.status}).`);
                    if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
                    return;
                }
                if (data.summary) {
                    displayMessageInChat(data.summary, 'bot summary-title', true);
                    allUserAnswers[currentCategoryLabel] = {
                        questions: questionsToAsk,
                        answers: userAnswersForCurrentCategory
                    };
                    console.log("Updated allUserAnswers:", allUserAnswers);
                }
                if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
            } catch (error) {
                removeLoadingMessage(loadingId);
                console.error('Error fetching category summary:', error);
                displayErrorMessageInChat("Terjadi masalah koneksi saat meminta summary kategori.");
            }
        }

        async function requestOverallSummary() {
            console.log("requestOverallSummary called.");
            if (Object.keys(allUserAnswers).length < 1) {
                alert("Selesaikan minimal satu kategori dulu.");
                return;
            }
            const overallSummaryCost = 5;
            if (currentUserCoins < overallSummaryCost) {
                alert(`Koin (${currentUserCoins}) tidak cukup. Butuh ${overallSummaryCost} koin.`);
                return;
            }
            if (requestOverallSummaryButton) requestOverallSummaryButton.disabled = true;
            const overallLoadingSpan = document.createElement('span');
            overallLoadingSpan.innerHTML =
                `<i>Sedang memproses rekomendasi final... <span class="spinner" style="border-top-color: var(--primary);"></span></i>`;
            if (overallSummaryTextElement) {
                overallSummaryTextElement.innerHTML = '';
                overallSummaryTextElement.appendChild(overallLoadingSpan);
            }
            if (overallSummaryContentElement) overallSummaryContentElement.classList.remove('hidden');
            try {
                const response = await fetch("{{ route('ai.mate.overallSummary') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        allUserAnswers: allUserAnswers
                    })
                });
                overallLoadingSpan.remove();
                if (requestOverallSummaryButton) requestOverallSummaryButton.disabled = false;
                const data = await response.json();
                console.log("Overall summary response data:", data);
                if (!response.ok) {
                    if (overallSummaryTextElement) overallSummaryTextElement.innerHTML =
                        `<p class="text-red-600 font-semibold">Error: ${data.error || `Gagal (Status: ${response.status}).`}</p>`;
                    if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
                    return;
                }
                if (data.summary && overallSummaryTextElement) overallSummaryTextElement.innerHTML = data.summary;
                if (data.new_coin_balance !== undefined) updateCoinBalanceUI(data.new_coin_balance);
            } catch (error) {
                overallLoadingSpan.remove();
                if (requestOverallSummaryButton) requestOverallSummaryButton.disabled = false;
                console.error('Error fetching overall summary:', error);
                if (overallSummaryTextElement) overallSummaryTextElement.innerHTML =
                    `<p class="text-red-600 font-semibold">Masalah koneksi saat meminta rekomendasi final.</p>`;
            }
        }

        function hideOverallSummaryContainer() {
            console.log("hideOverallSummaryContainer called.");
            if (overallSummaryContentElement) overallSummaryContentElement.classList.add('hidden');
        }

        // --- DOMContentLoaded HANYA UNTUK INISIALISASI ELEMEN DOM DAN EVENT LISTENER AWAL ---
        document.addEventListener('DOMContentLoaded', function() {
            console.log("DOMContentLoaded: Initializing DOM elements and Typed.js");

            coinBalanceElement = document.getElementById('user-coin-balance');
            categorySelectionModal = document.getElementById('category-selection-modal');
            selectionTitleElement = document.getElementById('selection-title');
            questionOptionsContainer = document.getElementById('question-options-container');
            questionConsoleElement = document.getElementById('question-console');
            consoleTitleElement = document.getElementById('console-title');
            chatHistoryElement = document.getElementById('chat-history');
            userInputElement = document.getElementById('user-input');
            sendButton = document.getElementById('send-button');
            overallSummaryContentElement = document.getElementById('overall-summary-content');
            overallSummaryTextElement = document.getElementById('overall-summary-text');
            requestOverallSummaryButton = document.getElementById('request-overall-summary-button');

            // Verifikasi apakah semua elemen penting ditemukan
            if (!categorySelectionModal) console.error("CRITICAL: categorySelectionModal NOT FOUND on DOM load!");
            if (!questionOptionsContainer) console.error(
                "CRITICAL: questionOptionsContainer NOT FOUND on DOM load!");
            if (!selectionTitleElement) console.error("CRITICAL: selectionTitleElement NOT FOUND on DOM load!");


            if (userInputElement) {
                userInputElement.addEventListener('keypress', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();
                        processUserInput(); // Pastikan processUserInput ada di global scope
                    }
                });
            } else {
                console.warn("User input element (user-input) not found on DOMContentLoaded");
            }

            const userName = "{{ Auth::user()->name ?? '' }}";
            const greeting = userName ? `Hai ${userName}!` : "Hai!";
            try {
                new Typed("#typed-welcome", {
                    strings: [
                        `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`
                    ],
                    typeSpeed: 30,
                    backSpeed: 10,
                    startDelay: 500,
                    loop: false,
                    showCursor: true,
                    cursorChar: '|',
                    onComplete: function(self) {
                        if (self.cursor) self.cursor.style.display = 'none';
                    }
                });
            } catch (e) {
                console.error("Typed.js initialization failed:", e);
                const typedWelcomeElement = document.getElementById('typed-welcome');
                if (typedWelcomeElement) typedWelcomeElement.textContent =
                    `${greeting} Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk, pilih kategori yang ingin kamu coba dulu!`;
            }
            console.log("DOMContentLoaded: Setup complete.");
        });
    </script>
@endsection
