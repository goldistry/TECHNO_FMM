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

        .header-ai {
            position: relative;
            display: inline-block;
        }

        .header-ai img {
            display: block;
        }

        .welcome-bubble {
            position: absolute;
            top: 10px;
            left: 110%;
            background-color: #a8c778;
            width: 300%;
            color: white;
            padding: 8px 12px;
            border-radius: 15px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .typed-cursor {
            opacity: 1;
            -webkit-animation: blink 0.7s infinite;
            animation: blink 0.7s infinite;
        }

        @-webkit-keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
    <div class="container min-h-[80%] mx-auto p-8 bg-[#f8f1e5]">
        <div class="header-ai">
            <img src="{{ asset('logoAI\AI.png') }}" alt="AI Mate Logo" style="width: 150px; height: auto;">
            <div class="welcome-bubble text-xl"><span class="auto-type"></span></div>
        </div>
        <h1 class="text-6xl font-bold text-center text-[#fd7205] mb-8">AI <span class="text-[#7f9c53]">MATE</span></h1>

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
            <div id="question-options" class="grid gap-2 grid-cols-1 md:grid-cols-4 lg:grid-cols-6">
            </div>
            <button onclick="hideCategorySelection()"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Kembali</button>
        </div>

        <div id="question-console" class="hidden flex flex-col bg-[#7f9c53] p-4 rounded-lg mb-4">
            <h2 id="console-title" class="text-2xl font-semibold text-white mb-4"></h2>
            <div id="chat-history" class="flex-grow overflow-y-auto mb-4"></div>
            <div class="input-area">
                <input type="text" id="user-input" placeholder="Ketik jawabanmu di sini..." class="text-white">
                <button onclick="processUserInput()">Kirim</button>
            </div>
            <button onclick="hideQuestionConsole()"
                class="bg-[#f8f1e5] hover:bg-[#ff933c] text-gray-800 hover:text-white font-semibold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">Tutup</button>
        </div>

        <div class="flex w-full flex-col items-center justify-center mt-8">
            <button onclick="showOverallSummary()"
                class="bg-[#ff933c] hover:bg-[#a8c778] text-white font-bold py-3 px-6 rounded-full focus:outline-none min-w-[250px] flex flex-col items-center justify-center">
                <span class="mb-1">Lihat Summary Keseluruhan</span>
                <div class="flex items-center gap-2">
                    <img src="{{ asset('logoAI/coin.png') }}" alt="coin Logo" class="w-5 h-auto">
                    <span>5 coins</span>
                </div>
            </button>
            <div id="overall-summary" class="mt-6 bg-white rounded-lg shadow-md p-6 hidden">
                <h2 class="text-2xl font-semibold text-[#fd7205] mb-4">Summary Keseluruhan</h2>
                <p class="text-gray-600" id="overall-summary-text">
                    @if (!empty($userAnswers['Bakat & Minat']) && !empty($userAnswers['Keinginan Orang Tua']))
                    @else
                        Silakan jawab pertanyaan dari minimal dua kategori terlebih dahulu.
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

            const gridContainer = document.getElementById('question-options');

            for (let i = 2; i <= totalQuestions; i++) {
                const button = document.createElement('button');
                button.className =
                    'bg-[#a8c778] hover:bg-[#7f9c53] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline flex items-center justify-center gap-2 min-w-0';

                const coinImage = document.createElement('img');
                coinImage.src = "{{ asset('logoAI/coin.png') }}";
                coinImage.alt = "Coin Logo";
                coinImage.style.width = '20px';
                coinImage.style.height = 'auto';

                const textSpan = document.createElement('span');
                const price = i * 15;
                textSpan.textContent = `${i} Quest`;
                const priceSpan = document.createElement('span');
                priceSpan.textContent = `${price} Coins`;

                button.appendChild(textSpan);
                button.appendChild(coinImage);
                button.appendChild(priceSpan);
                button.onclick = () => startQuestionConsole(i);
                gridContainer.appendChild(button);
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
                summaryText = `<strong>Analisis Rekomendasi Jurusan Berdasarkan Bakat dan Minat</strong><br><br>` +
                    `<strong>JURUSAN YANG MUNGKIN SESUAI BUAT KAMU:</strong><br><br>` +
                    `<strong>1. Desain Komunikasi Visual (DKV)</strong><br>` +
                    `    Alasan Jurusan DKV sangat cocok buat kamu karena menggabungkan elemen visual dari hobi videografi dan fotografi dengan pemahaman konseptual dan estetika yang seringkali dipengaruhi oleh kemampuan Matematika dalam hal komposisi, proporsi, dan ruang. Ketertarikan kamu pada Seni Rupa juga menjadi landasan penting dalam DKV, di mana kreativitas visual, penggunaan warna, tipografi, dan elemen desain lainnya sangat ditekankan. DKV memungkinkan kamu untuk menyalurkan kecintaan kamu pada visual melalui berbagai media seperti desain grafis, ilustrasi, animasi, web desain, hingga produksi video. Semangat dalam videografi dan fotografi kamu akan menjadi modal berharga dalam menciptakan konten visual yang menarik dan efektif. Sementara itu, pemahaman matematika dapat membantu kamu dalam aspek teknis desain dan pemecahan masalah visual yang kompleks. Apresiasi terhadap seni rupa akan memperkaya citra visual dan konsep desain yang dihasilkan.<br><br>` +
                    `<strong>2. Fotografi</strong><br>` +
                    `    Alasan Jurusan Fotografi adalah pilihan yang sangat jelas mengingat hobi kamu adalah fotografi. Jurusan ini akan mengembangkan kemampuan teknis dalam pengambilan gambar, pemahaman komposisi, pencahayaan, penggunaan peralatan, hingga proses pasca-produksi. Meskipun tidak secara langsung terkait dengan Matematika, pemahaman tentang rasio, perspektif, dan ruang dalam matematika dapat memberikan landasan yang baik dalam menciptakan komposisi foto yang menarik. Ketertarikan pada Seni Rupa juga sangat relevan karena fotografi adalah bentuk seni visual. Jurusan ini akan memungkinkan kamu untuk mendalami berbagai genre fotografi, mengembangkan gaya pribadinya, dan berpotensi berkarir sebagai fotografer profesional di berbagai bidang. Semangat kamu dalam memotret setiap hari akan menjadi pendorong utama untuk terus belajar dan berkembang dalam jurusan ini.<br><br>` +
                    `<strong>3. Film dan Televisi</strong><br>` +
                    `    Alasan Jurusan ini sangat sesuai dengan hobi kamu dalam videografi. Di sini, kamu akan belajar tentang proses produksi film dan televisi secara keseluruhan, mulai dari penulisan naskah, penyutradaraan, pengambilan gambar (sinematografi), penyuntingan video, hingga produksi suara. Meskipun Matematika mungkin tidak menjadi fokus utama, pemahaman tentang waktu, ritme, dan perencanaan yang logis akan berguna dalam proses produksi. Apresiasi terhadap Seni Rupa juga penting dalam aspek visual film dan televisi, seperti tata artistik, desain produksi, dan sinematografi. Semangat dalam membuat video setiap hari akan menjadi motivasi yang kuat untuk mempelajari seluk-beluk industri film dan televisi.<br><br>` +
                    `<strong>4. Arsitektur</strong><br>` +
                    `    Alasan Jurusan Arsitektur mungkin tampak kurang langsung terkait, namun ada irisan menarik antara hobi videografi dan fotografi dengan kemampuan visualisasi ruang dan detail dalam arsitektur. Kemampuan mengambil gambar dan video yang baik dapat membantu dalam mendokumentasikan proyek, membuat presentasi visual, dan memahami perspektif ruang. Ketertarikan pada Matematika, terutama geometri, perhitungan ruang, dan struktur, adalah fondasi penting dalam arsitektur. Selain itu, Seni Rupa juga berperan dalam estetika desain bangunan dan perencanaan ruang. Jika kamu memiliki ketertarikan pada desain ruang, visualisasi 3D, dan pemahaman struktural, jurusan ini bisa menjadi pilihan yang menarik yang menggabungkan aspek teknis dan kreatif.<br><br>` +
                    `<strong>5. Desain Grafis</strong><br>` +
                    `    Alasan Jurusan Desain Grafis adalah perpaduan yang kuat antara hobi fotografi (dalam hal visual dan komposisi) dan apresiasi terhadap Seni Rupa. Di sini, kamu akan belajar menciptakan karya visual untuk berbagai media, baik cetak maupun digital, menggunakan elemen desain seperti tipografi, warna, ilustrasi, dan fotografi. Pemahaman Matematika dalam hal proporsi, tata letak, dan grid sistem juga relevan dalam desain grafis. Semangat dalam menciptakan visual yang menarik dan efektif, yang mungkin sudah terasah melalui fotografi, akan menjadi aset berharga dalam jurusan ini.<br><br>` +
                    `<strong>6. Matematika (dengan spesialisasi tertentu, contohnya: Visualisasi Data, Grafika Komputer)</strong><br>` +
                    `    Alasan Meskipun hobi kamu lebih condong ke visual, ketertarikan yang kuat pada Matematika adalah hal yang signifikan. Jika kamu benar-benar menikmati tantangan logika dan pemecahan masalah dalam matematika, jurusan ini bisa menjadi pilihan yang tepat. Untuk menghubungkannya dengan hobi videografi dan fotografi serta Seni Rupa, kamu bisa mempertimbangkan spesialisasi dalam bidang seperti Visualisasi Data (mengubah data kompleks menjadi representasi visual yang menarik), Grafika Komputer (mempelajari algoritma di balik pembuatan gambar dan animasi komputer), atau bahkan bidang yang menggabungkan matematika dengan pemrosesan citra. Dalam hal ini, semangat dalam matematika akan menjadi fondasi, dan minat pada visual dapat diarahkan ke aplikasi matematika dalam konteks kreatif.`;
            } else if (categoryLabel === 'Keinginan Orang Tua') {
                summaryText =
                    `<strong>Analisis Rekomendasi Jurusan Berdasarkan Keinginan Orang Tua (Fokus Teknologi Informasi)</strong><br><br>` +
                    `<strong>1. Teknik Informatika</strong><br>` +
                    `    <strong>Alasan(Fokus Keinginan Orang Tua):</strong> Jurusan ini sangat relevan dengan keinginan orang tua kamu untuk bekerja di bidang Teknologi Informasi. Teknik Informatika akan membekali kamu dengan pengetahuan mendalam tentang pengembangan perangkat lunak, algoritma, struktur data, jaringan komputer, dan berbagai teknologi terkini.<br>` +
                    `        * Prospek Karir yang Jelas dan Stabil: Industri TI terus berkembang pesat, menciptakan permintaan tinggi untuk lulusan Teknik Informatika di berbagai sektor.<br>` +
                    `        * Gaji yang Tinggi: Profesi di bidang pengembangan perangkat lunak dan teknologi umumnya menawarkan gaji yang kompetitif.<br>` +
                    `        * Relevansi dengan Dunia Industri Modern: Ini adalah inti dari bidang TI. Lulusan akan terlibat langsung dalam perkembangan teknologi.<br>` +
                    `        * Peluang untuk Bekerja di Perusahaan Besar: Banyak perusahaan besar, baik di dalam maupun luar negeri, memiliki departemen TI yang besar dan membutuhkan tenaga ahli.<br><br>` +
                    `<strong>2. Sistem Informasi</strong><br>` +
                    `    <strong>Alasan(Fokus Keinginan Orang Tua):</strong> Jurusan ini berfokus pada bagaimana teknologi informasi digunakan untuk memecahkan masalah bisnis dan meningkatkan efisiensi organisasi. Ini adalah perpaduan antara pemahaman teknologi dan bisnis, yang sangat relevan dengan kebutuhan industri saat ini.<br>` +
                    `        * Prospek Karir yang Jelas dan Stabil: Permintaan akan ahli sistem informasi juga tinggi karena hampir semua organisasi bergantung pada sistem informasi.<br>` +
                    `        * Gaji yang Tinggi: Profesional di bidang ini umumnya memiliki penghasilan yang menarik.<br>` +
                    `        * Relevansi dengan Dunia Industri Modern: Sistem informasi adalah tulang punggung operasional banyak perusahaan modern.<br>` +
                    `        * Peluang untuk Bekerja di Perusahaan Besar: Perusahaan besar sangat membutuhkan ahli sistem informasi untuk mengelola dan mengembangkan infrastruktur TI mereka.<br><br>` +
                    `<strong>3. Ilmu Komputer</strong><br>` +
                    `    <strong>Alasan(Fokus Keinginan Orang Tua):</strong> Ilmu Komputer lebih teoritis dan mendasar, mempelajari prinsip-prinsip komputasi yang menjadi fondasi bagi banyak teknologi. Lulusan memiliki peran penting dalam inovasi dan pengembangan teknologi masa depan.<br>` +
                    `        * Prospek Karir yang Jelas dan Stabil: Lulusan Ilmu Komputer memiliki banyak peluang karir, terutama di bidang penelitian dan pengembangan teknologi baru.<br>` +
                    `        * Gaji yang Tinggi: Profesi yang membutuhkan pemahaman mendalam tentang teori komputasi seringkali dihargai dengan gaji yang tinggi.<br>` +
                    `        * Relevansi dengan Dunia Industri Modern: Ilmu Komputer adalah fondasi dari banyak inovasi teknologi saat ini dan di masa depan.<br>` +
                    `        * Peluang untuk Bekerja di Perusahaan Besar: Perusahaan teknologi besar sangat membutuhkan ahli di bidang ini untuk riset dan pengembangan produk inovatif.<br><br>` +
                    `<strong>4. Desain Komunikasi Visual (DKV) dengan fokus UI/UX atau Multimedia Interaktif</strong><br>` +
                    `    <strong>Alasan(Fokus Keinginan Orang Tua):</strong> Dengan fokus pada UI/UX atau Multimedia Interaktif, jurusan ini menggabungkan aspek desain visual dengan pemahaman teknologi digital. Ini adalah area yang sangat dibutuhkan dalam pengembangan produk digital modern.<br>` +
                    `        * Prospek Karir yang Jelas dan Stabil: Permintaan untuk desainer UI/UX dan multimedia interaktif terus meningkat seiring dengan perkembangan industri digital.<br>` +
                    `        * Gaji yang Tinggi: Profesional di bidang UI/UX dan multimedia dengan keahlian yang baik dapat memperoleh gaji yang menarik.<br>` +
                    `        * Relevansi dengan Dunia Industri Modern: Desain yang baik adalah kunci keberhasilan produk digital modern.<br>` +
                    `        * Peluang untuk Bekerja di Perusahaan Besar: Banyak perusahaan teknologi dan digital membutuhkan desainer UI/UX dan multimedia untuk mengembangkan produk mereka.<br><br>` +
                    `<strong>5. Manajemen Bisnis dengan fokus pada Teknologi atau E-commerce</strong><br>` +
                    `    <strong>Alasan(Fokus Keinginan Orang Tua):</strong> Jurusan ini membekali dengan pemahaman tentang bisnis dan bagaimana teknologi diterapkan dalam konteks tersebut, terutama dalam manajemen dan operasional perusahaan modern.<br>` +
                    `        * Prospek Karir yang Jelas dan Stabil: Lulusan manajemen bisnis dengan pemahaman teknologi memiliki peluang karir yang luas di berbagai industri yang semakin bergantung pada teknologi.<br>` +
                    `        * Gaji yang Tinggi: Posisi manajerial, terutama yang terkait dengan teknologi, umumnya menawarkan kompensasi yang baik.<br>` +
                    `        * Relevansi dengan Dunia Industri Modern: Hampir semua bisnis saat ini memanfaatkan teknologi, sehingga pemahaman tentang manajemen dan teknologi sangat relevan.<br>` +
                    `        * Peluang untuk Bekerja di Perusahaan Besar: Perusahaan besar membutuhkan profesional dengan pemahaman bisnis dan teknologi untuk mengelola operasi dan mengembangkan strategi mereka.<br><br>`;
            } else {
                summaryText += 'Summary untuk kategori ini belum diimplementasikan secara dinamis.';
            }

            const summaryMessage = document.createElement('div');
            summaryMessage.className =
                'chatbot-message bot-message self-start mt-2 whitespace-pre-line'; 
            summaryMessage.innerHTML = summaryText; 
            chatHistory.appendChild(summaryMessage);
            chatHistory.scrollTop = chatHistory.scrollHeight;
            updateOverallSummary();
        }

        function updateOverallSummary() {
            const overallSummaryText =
                `<strong>Baik, setelah mempertimbangkan bakat dan minatmu serta keinginan orang tuamu, berikut adalah rekomendasi summary keseluruhan dengan dua hingga tiga jurusan yang paling sesuai, beserta tingkat kecocokannya:</strong><br><br>` +
                `<strong>JURUSAN YANG DIREKOMENDASIKAN:</strong><br><br>` +
                `* <strong>Desain Komunikasi Visual (DKV) dengan fokus UI/UX atau Multimedia Interaktif</strong><br>` +
                `* <strong>Teknik Informatika</strong><br>` +
                `* <strong>Sistem Informasi</strong><br><br>` +
                `<strong>PER JURUSAN:</strong><br><br>` +
                `<strong>Desain Komunikasi Visual (DKV) dengan fokus UI/UX atau Multimedia Interaktif</strong><br>` +
                `<strong>ALASAN REASONING:</strong> Jurusan ini memiliki potensi terbesar untuk menggabungkan semangatmu dalam videografi dan fotografi serta apresiasimu terhadap Seni Rupa. Fokus pada UI/UX atau Multimedia Interaktif juga memberikan jembatan yang kuat ke dunia Teknologi Informasi yang diinginkan orang tuamu. Kamu akan belajar bagaimana menciptakan visual yang menarik dan fungsional untuk produk digital, yang saat ini sangat dibutuhkan di industri. Kemampuan Matematika dalam hal komposisi dan tata letak juga akan terpakai.<br>` +
                `<strong>TINGKAT KECOCOKAN:</strong><br>` +
                `<strong>Bakat dan Minat:</strong> 85%<br>` +
                `Alasan: Jurusan ini secara langsung mewadahi hobimu dalam visual dan seni. Kamu akan memiliki kesempatan untuk mengembangkan kreativitasmu dalam konteks digital yang dinamis.<br>` +
                `<strong>Keinginan Orang Tua:</strong> 70%<br>` +
                `Alasan: Jurusan ini berada di irisan antara desain dan teknologi, menawarkan prospek karir yang baik di industri digital yang terus berkembang. Meskipun mungkin tidak sepenuhnya "murni" TI seperti yang dibayangkan orang tuamu, permintaan untuk desainer UI/UX dan multimedia interaktif dengan pemahaman teknologi sangat tinggi dan menawarkan gaji yang kompetitif serta peluang di perusahaan besar. Relevansinya dengan dunia industri modern juga sangat kuat.<br><br>` +
                `<strong>Teknik Informatika</strong><br>` +
                `<strong>ALASAN REASONING:</strong> Jurusan ini sangat sesuai dengan keinginan orang tuamu untuk berkarir di bidang Teknologi Informasi. Kamu akan mempelajari dasar-dasar pengembangan perangkat lunak, algoritma, dan sistem komputer. Meskipun mungkin tidak secara langsung memanfaatkan hobimu dalam videografi dan fotografi, kemampuan Matematika yang kamu sukai akan menjadi fondasi yang kuat dalam belajar pemrograman dan logika komputasi. Kamu juga berpotensi menemukan cara untuk mengintegrasikan minat visualmu di masa depan, misalnya dalam pengembangan aplikasi dengan elemen visual yang menarik.<br>` +
                `<strong>TINGKAT KECOCOKAN:</strong><br>` +
                `<strong>Bakat dan Minat:</strong> 60%<br>` +
                `Alasan: Ketertarikanmu pada Matematika akan sangat terfasilitasi di jurusan ini. Namun, hobi visualmu mungkin tidak menjadi fokus utama dan perlu dicari cara untuk mengintegrasikannya secara mandiri.<br>` +
                `<strong>Keinginan Orang Tua:</strong> 90%<br>` +
                `Alasan: Jurusan ini sangat memenuhi semua kriteria yang diinginkan orang tuamu: prospek karir yang jelas dan stabil di industri TI yang terus berkembang, potensi gaji yang tinggi, relevansi yang sangat kuat dengan dunia industri modern, dan peluang besar untuk bekerja di perusahaan teknologi terkemuka.<br><br>` +
                `<strong>Sistem Informasi</strong><br>` +
                `<strong>ALASAN REASONING:</strong> Jurusan ini menawarkan perspektif yang lebih luas tentang bagaimana teknologi informasi diterapkan dalam konteks bisnis. Kamu akan belajar tentang analisis sistem, manajemen basis data, dan bagaimana teknologi dapat memecahkan masalah organisasi. Kemampuan Matematika dalam analisis data akan berguna. Meskipun tidak secara langsung terkait dengan hobi visualmu, pemahaman tentang antarmuka pengguna (UI) bisa menjadi area di mana minatmu bisa diterapkan. Jurusan ini juga sangat relevan dengan dunia Teknologi Informasi dan kebutuhan industri saat ini.<br>` +
                `<strong>TINGKAT KECOCOKAN:</strong><br>` +
                `<strong>Bakat dan Minat:</strong> 55%<br>` +
                `Alasan: Ketertarikanmu pada Matematika dalam hal analisis akan relevan. Namun, seperti Teknik Informatika, hobi visualmu mungkin tidak menjadi fokus utama dan perlu dicari cara untuk mengintegrasikannya dalam konteks bisnis atau desain antarmuka.<br>` +
                `<strong>Keinginan Orang Tua:</strong> 80%<br>` +
                `Alasan: Jurusan ini sangat memenuhi sebagian besar kriteria orang tuamu. Prospek karirnya jelas dan stabil di era digital, potensi gajinya menarik, relevansinya dengan industri modern sangat tinggi, dan peluang bekerja di perusahaan besar juga terbuka lebar karena hampir semua organisasi membutuhkan ahli sistem informasi.<br><br>` +
                `<strong>Kesimpulan:</strong><br>` +
                `Jika kamu ingin jurusan yang paling kuat mengakomodasi bakat dan minatmu sambil tetap relevan dengan dunia teknologi dan harapan orang tuamu, <strong>Desain Komunikasi Visual (DKV) dengan fokus UI/UX atau Multimedia Interaktif</strong> adalah pilihan yang sangat baik. Jika prioritas utamamu adalah memenuhi keinginan orang tua untuk berkarir di bidang Teknologi Informasi dengan prospek karir yang sangat solid, <strong>Teknik Informatika</strong> dan <strong>Sistem Informasi</strong> adalah pilihan yang tepat, meskipun kamu perlu mencari cara untuk tetap menyalurkan minat visualmu di luar perkuliahan atau dalam proyek-proyek tertentu.<br><br>` +
                `<strong>Saran saya</strong>, pikirkan baik-baik mana yang lebih penting bagimu saat ini: mengejar passion visualmu dengan tetap memiliki karir yang menjanjikan di dunia digital, atau fokus pada fondasi teknologi yang kuat seperti yang diinginkan orang tuamu sambil mencari cara untuk mengembangkan minat visualmu secara paralel. Diskusikan pilihan-pilihan ini dengan orang tuamu untuk mendapatkan perspektif yang lebih lengkap.`;

            overallSummaryElement.innerHTML = overallSummaryText;
        }

        function showOverallSummary() {
            document.getElementById('overall-summary').classList.remove('hidden');
        }

        function hideOverallSummary() {
            document.getElementById('overall-summary').classList.add('hidden');
        }
    </script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typed = new Typed(".auto-type", {
                strings: [
                    "Hai! Aku AI MATE yang siap membantu kamu memilih jurusan yang tepat. Yuk pilih kategori yang kamu mau coba dulu!"
                ],
                typeSpeed: 50,
                showCursor: true,
                cursorChar: '|',
                loop: false,
                onComplete: function(self) {
                    self.cursor.remove();
                }
            });
        });
    </script>
@endsection
