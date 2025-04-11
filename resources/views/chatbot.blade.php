@extends('layout')
@section('content')
    <style>
        #question-console {
            max-height: 400px;
            overflow-y: auto;
        }

        .chatbot-message {
            padding: 8px 12px;
            margin-bottom: 8px;
            border-radius: 8px;
        }

        .user-message {
            background-color: #edf2f7;
            color: #2d3748;
            align-self: flex-end;
        }

        .bot-message {
            background-color: #a8c778;
            color: white;
            font-weight: bold;
            align-self: flex-start;
        }

        .input-area {
            display: flex;
            gap: 8px;
            margin-top: 16px;
        }

        .input-area input[type="text"] {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            color: white;
        }

        .input-area button {
            padding: 8px 16px;
            background-color: #fd7205;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .input-area button:hover {
            background-color: #7f9c53;
        }

        .input-area input::placeholder {
            color: #cccccc;
            opacity: 1;
        }
    </style>
    </head>

    <div class="container min-h-[80%] mx-auto p-8 bg-[#f8f1e5]">
        <h1 class="text-3xl font-bold text-center text-[#7f9c53] mb-8">Find My Major Chatbot</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach ($categories as $id => $category)
                <div class="bg-white rounded-lg shadow-md p-6 cursor-pointer hover:shadow-lg transition duration-300"
                    onclick="showCategorySelection('{{ $id }}', {{ count($category['questions']) }})">
                    <h2 class="text-xl font-semibold text-[#fd7205] mb-2">{{ $category['label'] }}</h2>
                    <p class="text-gray-500 text-sm">{{ count($category['questions']) }} Pertanyaan</p>
                </div>
            @endforeach
        </div>

        <div id="category-selection" class="bg-white rounded-lg shadow-md p-6 mb-8 hidden">
            <h2 id="selection-title" class="text-2xl font-semibold text-gray-500 mb-4">Pilih Jumlah Pertanyaan</h2>
            <div id="question-options" class="flex gap-4"></div>
            <button onclick="hideCategorySelection()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Kembali</button>
        </div>

        <div id="question-console" class="hidden flex flex-col bg-[#7f9c53] p-4 rounded-lg mb-4">
            <h2 id="console-title" class="text-2xl font-semibold text-white mb-4"></h2>
            <div id="chat-history" class="flex-grow overflow-y-auto mb-4"></div>
            <div class="input-area">
                <input type="text" id="user-input" placeholder="Ketik jawaban Anda di sini..." class="text-white">
                <button onclick="processUserInput()">Kirim</button>
            </div>
            <button onclick="hideQuestionConsole()"
                class="bg-[#f8f1e5] hover:bg-[#ff933c] text-gray-800 hover:text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Tutup</button>
        </div>

        <div class="text-center">
            <button onclick="showOverallSummary()"
                class="bg-[#ff933c] hover:bg-[#a8c778] text-white font-bold py-3 px-6 rounded-full focus:outline-none ">
                Lihat Summary Keseluruhan
            </button>
            <div id="overall-summary" class="mt-6 bg-white rounded-lg shadow-md p-6 hidden">
                <h2 class="text-2xl font-semibold text-[#fd7205] mb-4">Summary Keseluruhan</h2>
                <p class="text-gray-600" id="overall-summary-text">
                    @if (!empty($userAnswers['Bakat & Minat']) && !empty($userAnswers['Keinginan Orang Tua']))
                        {{-- persentase dan jurusan kompromi --}}
                    @else
                        Silakan jawab pertanyaan Bakat & Minat dan Keinginan Orang Tua terlebih dahulu.
                    @endif
                </p>
                <button onclick="hideOverallSummary()"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Tutup</button>
            </div>
        </div>
    </div>

    <script>
        let currentCategoryId = null;
        let currentCategoryQuestions = [];
        let currentQuestionIndex = 0;
        const chatHistory = document.getElementById('chat-history');
        const userInput = document.getElementById('user-input');
        const consoleTitle = document.getElementById('console-title');
        const questionConsole = document.getElementById('question-console');
        const categorySelection = document.getElementById('category-selection');
        const questionOptions = document.getElementById('question-options');
        const selectionTitle = document.getElementById('selection-title');
        const categoriesData = @json($categories);
        const overallSummaryElement = document.getElementById('overall-summary-text');
        let userAnswers = {};

        function showCategorySelection(categoryId, totalQuestions) {
            currentCategoryId = categoryId;
            currentCategoryQuestions = [...categoriesData[categoryId].questions];
            selectionTitle.textContent = `Pilih Jumlah Pertanyaan untuk Kategori "${categoriesData[categoryId].label}"`;
            questionOptions.innerHTML = '';
            for (let i = 2; i <= totalQuestions; i++) {
                const button = document.createElement('button');
                button.textContent = i;
                button.className =
                    'bg-[#a8c778] hover:bg-[#7f9c53] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline';
                button.onclick = () => startQuestionConsole(i);
                questionOptions.appendChild(button);
            }
            categorySelection.classList.remove('hidden');
        }

        function hideCategorySelection() {
            categorySelection.classList.add('hidden');
        }

        function startQuestionConsole(numQuestions) {
            hideCategorySelection();
            questionConsole.classList.remove('hidden');
            consoleTitle.textContent = `Kategori: ${categoriesData[currentCategoryId].label}`;
            chatHistory.innerHTML = '';
            currentQuestionIndex = 0;
            currentCategoryQuestions = currentCategoryQuestions.slice(0, numQuestions);
            userAnswers[categoriesData[currentCategoryId].label] = [];
            displayNextQuestion();
        }

        function displayNextQuestion() {
            if (currentQuestionIndex < currentCategoryQuestions.length) {
                const question = currentCategoryQuestions[currentQuestionIndex];
                const botMessage = document.createElement('div');
                botMessage.className = 'chatbot-message bot-message self-start';
                botMessage.textContent = question;
                chatHistory.appendChild(botMessage);
                userInput.focus();
            } else {
                // kalau semua pertanyaan terjawab, tampilkan tombol summary
                const summaryButton = document.createElement('button');
                summaryButton.textContent = 'Lihat Summary Kategori';
                summaryButton.className =
                    'bg-[#ff933c] hover:bg-[#fd7205] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline self-center mt-4';
                summaryButton.onclick = () => displayCategorySummary();
                chatHistory.appendChild(summaryButton);
            }
        }

        function processUserInput() {
            const answer = userInput.value.trim();
            if (answer) {
                const userMessage = document.createElement('div');
                userMessage.className = 'chatbot-message user-message self-end';
                userMessage.textContent = answer;
                chatHistory.appendChild(userMessage);
                userAnswers[categoriesData[currentCategoryId].label].push(answer);
                userInput.value = '';
                currentQuestionIndex++;
                displayNextQuestion();
                chatHistory.scrollTop = chatHistory.scrollHeight; //scroll ke bawah
            }
        }

        function hideQuestionConsole() {
            questionConsole.classList.add('hidden');
        }

        function displayCategorySummary() {
            const categoryLabel = categoriesData[currentCategoryId].label;
            const answers = userAnswers[categoryLabel];
            let summaryText = `Summary Berdasarkan Jawaban Anda untuk Kategori "${categoryLabel}":\n`;

            if (categoryLabel === 'Bakat & Minat') {
                summaryText +=
                    `Jawaban 1: ${answers[0] || '-'}\nJawaban 2: ${answers[1] || '-'}\nBerdasarkan minat Anda, jurusan yang mungkin cocok adalah Desain Komunikasi Visual atau Film dan Televisi.`;
            } else if (categoryLabel === 'Keinginan Orang Tua') {
                summaryText +=
                    `Jawaban 1: ${answers[0] || '-'}\nJawaban 2: ${answers[1] || '-'}\nMempertimbangkan keinginan orang tua, jurusan seperti Teknik Informatika atau Sistem Informasi relevan.`;
            } else {
                summaryText += 'Summary untuk kategori ini belum diimplementasikan secara dinamis.';
            }

            const summaryMessage = document.createElement('div');
            summaryMessage.className = 'chatbot-message bot-message self-start mt-2';
            summaryMessage.textContent = summaryText;
            chatHistory.appendChild(summaryMessage);
            chatHistory.scrollTop = chatHistory.scrollHeight;
            updateOverallSummary();
        }

        function updateOverallSummary() {
            let bakatMinatSummary = '';
            let keinginanOrtuSummary = '';
            let bakatMinatMatch = {{ $bakatMinatMatch }}; 
            let keinginanOrtuMatch = {{ $keinginanOrtuMatch }}; 
            let kompromiJurusan = "{{ $kompromiJurusan }}"; 

            if (userAnswers['Bakat & Minat'] && userAnswers['Bakat & Minat'].length > 0) {
                bakatMinatSummary =
                    `Bakat & Minat: Berdasarkan jawaban Anda, jurusan yang mungkin cocok adalah Desain Komunikasi Visual atau Film dan Televisi (${bakatMinatMatch}%).\n`;
            }

            if (userAnswers['Keinginan Orang Tua'] && userAnswers['Keinginan Orang Tua'].length > 0) {
                keinginanOrtuSummary =
                    `Keinginan Orang Tua: Mempertimbangkan keinginan orang tua di bidang teknologi, jurusan seperti Teknik Informatika atau Sistem Informasi (${keinginanOrtuMatch}%).\n`;
            }

            overallSummaryElement.textContent = bakatMinatSummary + keinginanOrtuSummary +
                "Kemungkinan jurusan kompromi: " + kompromiJurusan + ".";
        }

        function showOverallSummary() {
            document.getElementById('overall-summary').classList.remove('hidden');
        }

        function hideOverallSummary() {
            document.getElementById('overall-summary').classList.add('hidden');
        }
    </script>
@endsection
