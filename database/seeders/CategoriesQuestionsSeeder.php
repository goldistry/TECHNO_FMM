<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class CategoriesQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kosongkan tabel terlebih dahulu untuk menghindari duplikat jika seeder dijalankan ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Category::truncate();
        Question::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categoriesData = [
            'bakat_minat' => [
                'label' => 'Bakat & Minat',
                'description' => 'Eksplorasi hobi, ketertarikan, dan aktivitas yang membuatmu bersemangat untuk menemukan potensi terbesarmu.',
                'icon_identifier' => '🎯',
                'cost_per_question' => 15,
                'questions' => [
                    "Hobi / aktivitas apa yang bikin kamu semangat melakukannya setiap hari? (Contoh: Bikin sketsa gambar, main rubik dan puzzle, menulis cerita, bermain alat musik, merakit model, berolahraga spesifik)",
                    "Pelajaran sekolah apa yang paling kamu tunggu-tunggu di sekolah dan mengapa? (Contoh: Seni rupa karena bisa mengekspresikan diri, Matematika karena suka memecahkan masalah yang logis, Biologi karena penasaran dengan makhluk hidup)",
                    "Jika kamu punya waktu luang satu hari penuh untuk melakukan apa saja yang berkaitan dengan pengembangan diri atau eksplorasi, kegiatan spesifik apa yang akan kamu pilih dan mengapa?",
                    "Materi atau topik apa di luar pelajaran sekolah yang sering kamu pelajari sendiri karena rasa penasaran yang tinggi? (Contoh: Belajar coding dasar, mempelajari sejarah peradaban kuno, mengikuti tutorial desain grafis)",
                    "Prestasi atau pencapaian apa (formal maupun informal) yang paling membuatmu bangga dan berkaitan dengan minat atau bakatmu?",
                    "Jenis bacaan apa (buku, artikel, blog) yang paling sering kamu baca di waktu luang? Sebutkan topik atau genre spesifiknya.",
                    "Jika kamu harus menjelaskan satu hal yang sangat kamu kuasai kepada orang lain, hal apakah itu?",
                    "Kegiatan apa yang membuatmu merasa 'tenggelam' dalam waktu hingga lupa sekitar? (Flow state)",
                ],
            ],
            'keinginan_ortu' => [
                'label' => 'Keinginan Orang Tua',
                'description' => 'Memahami harapan dan perspektif orang tua sebagai salah satu bahan pertimbangan penting dalam pilihanmu.',
                'icon_identifier' => '👨‍👩‍👧‍👦',
                'cost_per_question' => 15,
                'questions' => [
                    "Orang tua ingin kamu bekerja di bidang apa? (Contoh: teknik informatika karena memiliki prospek kerja yang lebih stabil, dokter karena profesi mulia, pengusaha agar mandiri)",
                    "Aspek apa dari jurusan yang orang tuamu harapkan bisa ditemukan di jurusan pilihanmu? (Contoh: Kerja di bidang teknologi, jaminan karir yang jelas, gaji awal yang tinggi, jurusan yang linier dengan bisnis keluarga)",
                    "Apakah ada kriteria minimum yang orang tua harapkan jika kamu memilih jurusan di luar harapan mereka? (Misalnya: akreditasi A, universitas negeri ternama, prospek kerja yang sudah terbukti, atau biaya kuliah yang terjangkau)",
                    "Seberapa besar orang tua memberikan kebebasan dalam memilih jurusan? Apakah ada diskusi atau negosiasi yang mungkin dilakukan terkait pilihanmu?",
                ],
            ],
            'financial' => [
                'label' => 'FINANCIAL',
                'description' => 'Analisis aspek finansial, termasuk biaya kuliah dan biaya hidup, untuk membuat perencanaan yang realistis.',
                'icon_identifier' => '💰',
                'cost_per_question' => 15,
                'questions' => [
                    "Bagaimana kamu merencanakan pengelolaan keuangan pribadimu selama masa kuliah jika mendapatkan uang saku bulanan? (Contoh: Membuat anggaran detail, menyisihkan untuk tabungan, mencari penghasilan tambahan)",
                    "Sejauh mana kamu memahami konsep perbedaan antara biaya kuliah (UKT/SPP), biaya hidup (kos, makan, transportasi), dan biaya pendukung kuliah (buku, alat praktik) dalam merencanakan keuanganmu?",
                    "Kamu berencana kuliah di kota besar yang mungkin biaya hidupnya tinggi, di kota dekat rumah, atau tidak masalah di mana saja selama jurusannya sesuai? Faktor biaya ini seberapa penting untukmu?",
                    "Apakah orang tuamu sudah menyiapkan dana pendidikan khusus untuk kuliahmu secara penuh, sebagian, atau kamu diharapkan bisa berkontribusi/mencari beasiswa?",
                    "Jika ternyata jurusan yang sangat kamu minati memiliki biaya yang lebih tinggi dari perkiraan, langkah apa yang akan kamu pertimbangkan? (Contoh: Mencari beasiswa lebih giat, mencari kerja paruh waktu, diskusi ulang dengan orang tua, mencari alternatif kampus dengan jurusan serupa)",
                ],
            ],
            'prospek_karir' => [
                'label' => 'PROSPEK KARIR',
                'description' => 'Memvisualisasikan masa depan karir, memahami tren industri, dan menentukan prioritas dalam dunia kerja.',
                'icon_identifier' => '📈',
                'cost_per_question' => 15,
                'questions' => [
                    "Bayangkan 10 tahun dari sekarang, lingkungan kerja seperti apa yang ideal menurutmu? (Contoh: Bekerja di perusahaan teknologi multinasional, startup yang dinamis, lembaga riset, menjadi freelancer, memimpin tim sendiri)",
                    "Menurutmu, lebih penting memilih karir yang memiliki potensi penghasilan besar walau kurang diminati, atau karir dengan peluang untuk berkembang pesat dalam bidang yang sangat kamu minati meskipun potensi penghasilan awalnya standar? Mengapa?",
                    "Bagaimana kamu melihat prospek karir di bidang yang kamu minati saat ini dalam lima tahun ke depan, terutama dengan adanya perkembangan teknologi seperti AI?",
                    "Keterampilan spesifik apa (selain ijazah) yang menurutmu paling penting untuk dikuasai agar bisa sukses di jalur karir yang kamu bayangkan?",
                    "Seberapa penting bagimu untuk memiliki dampak sosial atau kontribusi positif kepada masyarakat melalui pekerjaanmu nanti? Berikan contohnya.",
                    "Apakah kamu lebih tertarik pada jalur karir sebagai spesialis (ahli di satu bidang mendalam) atau generalis (memiliki pengetahuan di berbagai bidang dan bisa menghubungkannya)?",
                    "Tantangan terbesar apa yang kamu antisipasi dalam mengembangkan karir profesionalmu di masa depan, dan bagaimana rencanamu untuk menghadapinya?",
                    "Selain gaji dan jabatan, faktor apa lagi yang menjadi prioritas utamamu dalam memilih sebuah pekerjaan? (Contoh: Keseimbangan kerja-hidup, budaya perusahaan, kesempatan belajar, rekan kerja yang suportif)",
                ],
            ],
            'nilai_prinsip_hidup' => [
                'label' => 'Nilai dan Prinsip Hidup',
                'description' => 'Menggali nilai-nilai inti yang menjadi kompas dalam mengambil keputusan dan bertindak.',
                'icon_identifier' => '⚖️',
                'cost_per_question' => 15,
                'questions' => [
                    "Ketika menghadapi masalah kompleks, apakah kamu lebih cenderung: A. Menganalisis akar masalah dan mencari solusi logis langkah demi langkah (Problem Solver), B. Menciptakan ide-ide baru atau pendekatan yang belum pernah ada sebelumnya (Creator), C. Mengarahkan dan memotivasi orang lain untuk bekerja sama mencapai tujuan (Leader), D. Memastikan semua orang merasa didukung dan proses berjalan lancar (Support System)",
                    "Dalam sebuah proyek tim, peran apa yang paling sering kamu ambil atau paling nyaman kamu jalani?",
                    "Nilai apa yang paling kamu junjung tinggi dalam bekerja atau belajar? (Contoh: Kejujuran, inovasi, kolaborasi, ketelitian, kemandirian, kebermanfaatan)",
                    "Situasi seperti apa yang membuatmu merasa paling termotivasi dan bersemangat dalam melakukan sesuatu? (Contoh: Ketika berhasil memecahkan teka-teki sulit, ketika ideku diapresiasi dan diwujudkan, ketika bisa membantu orang lain mencapai tujuannya)",
                    "Jika kamu melihat ada sesuatu yang tidak efisien atau bisa diperbaiki dalam sebuah sistem/proses, apa reaksimu? Apakah kamu cenderung mengkritisi, menawarkan solusi, atau membiarkannya?",
                    "Mana yang lebih menggambarkan dirimu: Seseorang yang fokus pada hasil akhir (goal-oriented) atau seseorang yang menikmati proses perjalanan (process-oriented)?",
                    "Seberapa penting bagimu untuk memiliki otonomi atau kebebasan dalam caramu bekerja atau belajar?",
                    "Ketika dihadapkan pada pilihan sulit yang melibatkan nilai-nilaimu, bagaimana biasanya kamu mengambil keputusan?",
                ],
            ],
            'gaya_belajar' => [
                'label' => 'Gaya Belajar',
                'description' => 'Mengenali cara terbaik dan paling efektif bagi dirimu untuk menyerap informasi dan mempelajari hal-hal baru.',
                'icon_identifier' => '📚',
                'cost_per_question' => 15,
                'questions' => [
                    "Saat mempelajari konsep baru yang sulit, metode mana yang paling membantumu untuk paham? A. Melihat diagram, grafik, video, atau presentasi (Visual), B. Mendengarkan penjelasan, diskusi, atau podcast (Auditori), C. Melakukan praktik langsung, eksperimen, atau simulasi (Kinestetik), D. Membaca teks atau membuat catatan detail (Membaca/Menulis)",
                    "Ketika kamu harus mengingat informasi penting, cara apa yang paling efektif untukmu? (Contoh: Membuat mind map berwarna, merekam suara penjelasan dan mendengarkannya berulang kali, mencoba mempraktikkannya, menulis ulang poin-poin kunci)",
                    "Jika kamu diminta untuk mengajarkan suatu topik kepada teman, bagaimana caramu menyiapkannya? (Contoh: Membuat slide presentasi menarik, menyiapkan poin-poin untuk diskusi lisan, membuat alat peraga, menyusun handout ringkas)",
                    "Lingkungan belajar seperti apa yang paling ideal untukmu? (Contoh: Tempat yang tenang dan minim distraksi visual, tempat yang boleh sambil mendengarkan musik, tempat yang memungkinkan untuk bergerak atau berjalan-jalan)",
                    "Ketika kamu bosan atau kehilangan fokus saat belajar, kegiatan apa yang biasanya kamu lakukan untuk kembali berkonsentrasi?",
                    "Bayangkan kamu sedang merakit furnitur baru. Apakah kamu akan: A. Memperhatikan gambar dan diagram instruksi dengan seksama? (Visual), B. Meminta seseorang membacakan instruksinya atau menonton video tutorial dengan narasi? (Auditori), C. Langsung mencoba merakitnya dan belajar dari kesalahan (trial and error)? (Kinestetik), D. Membaca manual instruksi dari awal sampai akhir secara detail? (Membaca/Menulis)",
                    "Dalam memahami sebuah cerita atau narasi, mana yang lebih kamu nikmati: Membaca novelnya, mendengarkan audiobook, atau menonton film adaptasinya?",
                    "Saat belajar kelompok, kontribusi seperti apa yang paling sering kamu berikan? (Contoh: Membuat rangkuman visual, memimpin diskusi, mencatat hasil diskusi, atau aktif mencoba berbagai pendekatan)",
                ],
            ],
            'tipe_kecerdasan' => [
                'label' => 'Tipe Kecerdasan',
                'description' => 'Mengidentifikasi area kecerdasan majemuk (multiple intelligences) di mana kamu paling unggul.',
                'icon_identifier' => '💡',
                'cost_per_question' => 15,
                'questions' => [
                    "Aktivitas mana yang paling kamu nikmati dan merasa paling mahir? A. Menulis/berdebat (Linguistik), B. Memecahkan teka-teki logika (Logika-Matematis), C. Menggambar/mendesain (Spasial/Artistik), D. Bermain alat musik (Musikal), E. Berolahraga/menari (Kinestetik), F. Bekerja sama dalam tim (Interpersonal), G. Memahami diri sendiri/merenung (Intrapersonal), H. Mengamati alam (Naturalis)",
                    "Jika kamu diminta untuk mempresentasikan sebuah ide, format apa yang akan kamu pilih untuk membuatnya paling menarik dan mudah dipahami? (Contoh: Pidato yang persuasif, presentasi data dengan grafik, pameran visual, pertunjukan musik, demonstrasi langsung)",
                    "Masalah atau teka-teki jenis apa yang paling menantang sekaligus paling memuaskan untuk kamu pecahkan? (Contoh: Teka-teki silang/kata, Sudoku/problem matematika, menyusun strategi permainan, menciptakan karya seni)",
                    "Dalam kelompok, bagaimana kamu biasanya berkontribusi paling efektif? (Contoh: Sebagai penulis/editor, sebagai analis data, sebagai desainer materi, sebagai pencipta suasana, sebagai motivator)",
                    "Ketika kamu mempelajari hal baru, apakah kamu lebih suka: Memahaminya melalui kata-kata dan penjelasan, melalui angka dan pola, melalui gambar dan bentuk, atau melalui pengalaman langsung?",
                    "Kegiatan ekstrakurikuler atau klub apa di sekolah (atau di luar sekolah) yang paling menarik minatmu atau pernah/ingin kamu ikuti?",
                    "Jika kamu bisa menjadi ahli dalam satu bidang secara instan, bidang apakah itu? (Biarkan jawaban terbuka untuk melihat kecenderungan alaminya)",
                    "Jenis permainan apa yang paling kamu sukai? (Contoh: Permainan kata, permainan strategi, puzzle, permainan musik, olahraga tim, permainan peran)",
                ],
            ],
            'kepribadian' => [
                'label' => 'Kepribadian',
                'description' => 'Mengenal preferensi dan kecenderungan alami dirimu dalam berinteraksi, mengambil keputusan, dan merespon situasi.',
                'icon_identifier' => '🎭',
                'cost_per_question' => 15,
                'questions' => [
                    "Setelah seharian beraktivitas sosial yang padat, apa yang kamu butuhkan untuk mengisi ulang energimu? A. Menyendiri, membaca buku, atau melakukan aktivitas tenang lainnya (Introvert), B. Bertemu lebih banyak orang, mengobrol, atau pergi ke tempat ramai (Ekstrovert)",
                    "Ketika mengambil keputusan penting, mana yang lebih dominan kamu pertimbangkan? A. Analisis logis, fakta objektif, dan konsistensi (Thinking), B. Dampak pada perasaan orang lain, nilai-nilai pribadi, dan harmoni (Feeling)",
                    "Bagaimana kamu biasanya menghadapi tenggat waktu atau jadwal? A. Lebih suka merencanakan segala sesuatu dengan detail dan menyelesaikan pekerjaan jauh sebelum tenggat waktu (Judging/Teratur), B. Lebih suka bekerja mendekati tenggat waktu dan fleksibel terhadap perubahan rencana (Perceiving/Fleksibel)",
                    "Jika dihadapkan pada situasi baru atau tidak terduga, bagaimana reaksimu? A. Merasa tertantang dan antusias untuk mencoba hal baru tersebut. B. Merasa sedikit cemas dan butuh waktu untuk beradaptasi atau mengumpulkan informasi lebih dulu.",
                    "Dalam mengerjakan tugas, apakah kamu lebih suka: A. Mengikuti instruksi yang jelas dan prosedur yang sudah ada. B. Mencari cara sendiri yang mungkin lebih inovatif atau efisien, meskipun berisiko.",
                    "Ketika berinteraksi dengan orang baru, apakah kamu: A. Cenderung lebih banyak mendengarkan dan mengamati terlebih dahulu. B. Cenderung lebih aktif memulai percakapan dan mudah bergaul.",
                    "Menurutmu, mana yang lebih penting dalam sebuah tim: A. Tercapainya tujuan secara efisien dan efektif. B. Terjaganya hubungan baik dan suasana positif antar anggota tim.",
                    "Dalam situasi yang menantang atau penuh tekanan, bagaimana kamu biasanya merespon? A. Langsung mengambil alih, tegas, dan fokus pada hasil (Dominance), B. Antusias, persuasif, dan mencoba mempengaruhi orang lain (Influence), C. Tenang, sabar, dan berusaha menjaga stabilitas (Steadiness), D. Hati-hati, teliti, dan memastikan semua sesuai aturan (Conscientiousness)",
                ],
            ],
        ];

        foreach ($categoriesData as $slug => $data) {
            $category = Category::create([
                'slug' => $slug,
                'label' => $data['label'],
                'description' => $data['description'] ?? null,
                'icon_identifier' => $data['icon_identifier'] ?? '📋',
                'cost_per_question' => $data['cost_per_question'] ?? 15,
            ]);

            foreach ($data['questions'] as $index => $questionText) {
                Question::create([
                    'category_id' => $category->id,
                    'text' => $questionText,
                    'order' => $index + 1,
                ]);
            }
        }
    }
}