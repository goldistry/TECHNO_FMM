<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Major::insert([
            // Kategori: Sains & Teknologi
            [
                'title' => 'Teknik Informatika',
                'short_desc' => 'Mempelajari software, algoritma, dan pemrograman.',
                'full_desc' => 'Jurusan Teknik Informatika mengajarkan bagaimana merancang, mengembangkan, dan memelihara perangkat lunak serta memahami struktur data dan algoritma yang efisien. Mahasiswa akan mendalami berbagai bahasa pemrograman, sistem operasi, jaringan komputer, serta pengembangan aplikasi mobile dan web. Bidang ini sangat dinamis dan terus berkembang seiring inovasi teknologi.',
                'img' => 'https://universitasmulia.ac.id/wp-content/uploads/2021/05/ilustrasi-informatics-1030x579.jpg',
                'video_url' => 'https://www.youtube.com/embed/FPs_MK245Y0?si=N5EPdpqGy9f5LG3H" title="YouTube video player',
                'category' => 'Sains & Teknologi',
                'required_skills' => json_encode(['Logika & Pemecahan Masalah', 'Pemrograman', 'Analisis Data', 'Kreativitas', 'Kerja Tim']),
                'career_prospects' => json_encode(['Software Engineer', 'Data Scientist', 'Web Developer', 'Mobile Developer', 'Network Administrator', 'IT Consultant'])
            ],
            [
                'title' => 'Sistem Informasi',
                'short_desc' => 'Penggabungan teknologi dan bisnis.',
                'full_desc' => 'Sistem Informasi fokus pada perancangan, implementasi, dan pengelolaan sistem informasi dalam organisasi untuk mendukung proses bisnis dan pengambilan keputusan. Jurusan ini menjembatani kesenjangan antara teknologi dan bisnis, memastikan bahwa sistem teknologi informasi dapat memenuhi kebutuhan strategis perusahaan.',
                'img' => 'https://dibimbing-cdn.sgp1.cdn.digitaloceanspaces.com/media-strapi/648d598c24c3d1239f38ef797f150f8f.webp',
                'video_url' => null,
                'category' => 'Sains & Teknologi',
                'required_skills' => json_encode(['Analisis Bisnis', 'Manajemen Proyek', 'Database Management', 'Komunikasi', 'Pemahaman Teknologi']),
                'career_prospects' => json_encode(['System Analyst', 'IT Project Manager', 'Business Analyst', 'Database Administrator', 'ERP Consultant'])
            ],
            [
                'title' => 'Teknik Elektro',
                'short_desc' => 'Riset dan pengembangan perangkat elektronik dan sistem listrik.',
                'full_desc' => 'Teknik Elektro adalah bidang yang luas yang mencakup studi, desain, dan aplikasi peralatan, perangkat, dan sistem yang menggunakan listrik, elektronika, dan elektromagnetisme. Ini mencakup segala hal mulai dari sirkuit mikro hingga sistem pembangkit listrik skala besar.',
                'img' => 'https://ftmm.unair.ac.id/wp-content/uploads/prodi/nicolas-thomas-3GZi6OpSDcY-unsplash-scaled.jpg',
                'video_url' => 'https://www.youtube.com/embed/f71z5dA2Eyw?si=bveqlaNnTLZJZHZF',
                'category' => 'Sains & Teknologi',
                'required_skills' => json_encode(['Matematika & Fisika', 'Analisis Sirkuit', 'Pemecahan Masalah', 'Desain Sistem', 'Inovasi']),
                'career_prospects' => json_encode(['Electrical Engineer', 'Control System Engineer', 'Telecommunication Engineer', 'Power System Engineer', 'R&D Engineer'])
            ],
            [
                'title' => 'Arsitektur',
                'short_desc' => 'Desain dan perencanaan bangunan serta lingkungan.',
                'full_desc' => 'Jurusan Arsitektur menggabungkan seni dan sains untuk merancang bangunan dan ruang yang fungsional, estetis, dan berkelanjutan. Mahasiswa akan belajar tentang sejarah arsitektur, struktur bangunan, material, perencanaan kota, hingga penggunaan software desain arsitektur. Jurusan ini menekankan pada kreativitas, inovasi, dan pemahaman mendalam tentang dampak lingkungan dan sosial dari desain.',
                'img' => 'https://www.linovhr.com/wp-content/uploads/2023/03/arsitek-adalah.webp',
                'video_url' => 'https://www.youtube.com/embed/aAglSNEwn0M?si=kokne0ybhNG5sFUa" title="YouTube video player',
                'category' => 'Sains & Teknologi',
                'required_skills' => json_encode(['Sketsa & Gambar Teknis', 'Kreativitas', 'Pemahaman Ruang', 'Software Desain (CAD, SketchUp)', 'Perencanaan & Organisasi']),
                'career_prospects' => json_encode(['Arsitek', 'Desainer Interior', 'Perencana Kota', 'Kontraktor', 'Pengembang Properti'])
            ],
            [
                'title' => 'Matematika',
                'short_desc' => 'Studi tentang kuantitas, struktur, ruang, dan perubahan.',
                'full_desc' => 'Jurusan Matematika berfokus pada penalaran abstrak, pengembangan model matematika, dan penerapan konsep-konsep matematika untuk memecahkan masalah kompleks di berbagai bidang, mulai dari sains dan teknik hingga keuangan dan komputasi.',
                'img' => 'https://cdn.uconnectlabs.com/wp-content/uploads/sites/7/2019/08/math.jpg',
                'video_url' => null,
                'category' => 'Sains & Teknologi',
                'required_skills' => json_encode(['Analisis Logis', 'Pemecahan Masalah', 'Abstraksi', 'Ketelitian', 'Penalaran Kuantitatif']),
                'career_prospects' => json_encode(['Aktuaris', 'Data Scientist', 'Peneliti', 'Analis Keuangan', 'Pengajar'])
            ],

            // Kategori: Seni & Desain
            [
                'title' => 'Desain Komunikasi Visual',
                'short_desc' => 'Visual branding, ilustrasi, dan multimedia.',
                'full_desc' => 'Jurusan ini mengajarkan cara mengomunikasikan pesan melalui elemen visual seperti grafis, tipografi, warna, dan media interaktif. Mahasiswa akan belajar tentang desain grafis, ilustrasi, fotografi, animasi, web design, dan branding. DKV mempersiapkan desainer kreatif yang mampu menghasilkan solusi visual untuk berbagai kebutuhan industri, mulai dari periklanan hingga pengembangan game. Penting bagi lulusan DKV untuk selalu mengikuti tren visual dan teknologi terbaru.',
                'img' => 'https://dkv.fkip.um-surabaya.ac.id/assets/img/news_img/11558e19-a1df-11ed-a993-000c29cc32a6_beritadkv3.png',
                'video_url' => 'https://www.youtube.com/embed/twh8LlyhsD0?si=bbRlwbV5fC3Tdm_l" title="YouTube video player',
                'category' => 'Seni & Desain',
                'required_skills' => json_encode(['Kreativitas', 'Software Desain (Adobe Creative Suite)', 'Ilustrasi', 'Tipografi', 'Pemahaman Warna', 'Storytelling Visual']),
                'career_prospects' => json_encode(['Graphic Designer', 'UI/UX Designer', 'Illustrator', 'Motion Graphic Designer', 'Brand Designer', 'Art Director'])
            ],
            [
                'title' => 'Seni Rupa',
                'short_desc' => 'Eksplorasi artistik melalui berbagai media.',
                'full_desc' => 'Seni Rupa adalah jurusan yang berfokus pada penciptaan karya seni visual melalui berbagai media seperti lukisan, patung, seni instalasi, seni pertunjukan, dan media baru. Mahasiswa akan mengembangkan kepekaan estetik, kemampuan teknis, dan pemikiran konseptual untuk mengekspresikan ide dan emosi melalui karya seni.',
                'img' => 'https://rencanamu.id/assets/file_uploaded/blog/1566277127-expressive.jpg',
                'video_url' => null,
                'category' => 'Seni & Desain',
                'required_skills' => json_encode(['Kreativitas', 'Gambar & Melukis', 'Sculpting', 'Pemikiran Konseptual', 'Eksplorasi Material']),
                'career_prospects' => json_encode(['Seniman Profesional', 'Kurator Seni', 'Galleri Manager', 'Restorator Seni', 'Pendidik Seni'])
            ],
            [
                'title' => 'Film dan Televisi',
                'short_desc' => 'Produksi dan analisis karya audiovisual.',
                'full_desc' => 'Jurusan Film dan Televisi mempelajari seluruh aspek produksi film dan program televisi, mulai dari pra-produksi (penulisan skenario, casting), produksi (pengambilan gambar, penyutradaraan), hingga pasca-produksi (editing, tata suara, efek visual). Mahasiswa akan mendapatkan pemahaman mendalam tentang teori film, sejarah media, dan teknik pembuatan konten audiovisual yang menarik dan bermakna.',
                'img' => 'https://assets-a1.kompasiana.com/items/album/2017/03/30/filmandclapboard-58dc894e7697732409578100.jpg',
                'video_url' => null,
                'category' => 'Seni & Desain',
                'required_skills' => json_encode(['Storytelling', 'Penyutradaraan', 'Editing Video', 'Pengambilan Gambar', 'Manajemen Produksi']),
                'career_prospects' => json_encode(['Sutradara', 'Produser', 'Editor Video', 'Sinematografer', 'Penulis Skenario', 'Animator'])
            ],

            // Kategori: Bisnis & Ekonomi
            [
                'title' => 'Manajemen Bisnis',
                'short_desc' => 'Strategi, pemasaran, dan keuangan bisnis.',
                'full_desc' => 'Jurusan Manajemen Bisnis mengajarkan perencanaan, pengorganisasian, dan pengelolaan sumber daya untuk mencapai tujuan bisnis secara efektif. Kurikulumnya mencakup berbagai aspek seperti pemasaran, keuangan, sumber daya manusia, operasional, dan strategi bisnis. Mahasiswa akan mengembangkan kemampuan kepemimpinan, analisis, dan pengambilan keputusan yang krusial di dunia bisnis. Lulusan siap berkarir di berbagai sektor industri, baik sebagai manajer, konsultan, analis, atau bahkan membangun bisnis sendiri.',
                'img' => 'https://mvnu.edu/content/uploads/2024/01/mvnu-online-difference-between-admin-and-business-management.jpeg.webp',
                'video_url' => null,
                'category' => 'Bisnis & Ekonomi',
                'required_skills' => json_encode(['Kepemimpinan', 'Analisis Bisnis', 'Manajemen Proyek', 'Negosiasi', 'Komunikasi', 'Pemecahan Masalah']),
                'career_prospects' => json_encode(['Manajer Pemasaran', 'Manajer Keuangan', 'Manajer SDM', 'Konsultan Bisnis', 'Pengusaha', 'Analis Bisnis'])
            ],
            [
                'title' => 'Akuntansi',
                'short_desc' => 'Pencatatan dan analisis transaksi keuangan.',
                'full_desc' => 'Jurusan Akuntansi mengajarkan prinsip dan praktik pencatatan, pengklasifikasian, peringkasan, dan pelaporan transaksi keuangan. Mahasiswa akan mendalami standar akuntansi, audit, perpajakan, dan sistem informasi akuntansi. Lulusan akuntansi memiliki peran vital dalam menjaga transparansi dan kesehatan finansial suatu organisasi, serta memberikan informasi untuk pengambilan keputusan yang tepat.',
                'img' => 'https://cdn1-production-images-kly.akamaized.net/kmOUCMTaOP2Z4SNZPJz3ZhxMs_E=/1200x900/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/3242695/original/048304100_1600496185-pexels-pixabay-53621.jpg',
                'video_url' => null,
                'category' => 'Bisnis & Ekonomi',
                'required_skills' => json_encode(['Ketelitian', 'Analisis Numerik', 'Pemahaman Peraturan Keuangan', 'Software Akuntansi', 'Integritas']),
                'career_prospects' => json_encode(['Akuntan Publik', 'Auditor', 'Analis Keuangan', 'Manajer Pajak', 'Internal Auditor', 'Forensic Accountant'])
            ],

            // Kategori: Sosial & Humaniora
            [
                'title' => 'Psikologi',
                'short_desc' => 'Perilaku manusia dan kesehatan mental.',
                'full_desc' => 'Psikologi membahas aspek mental, emosional, dan perilaku manusia, baik secara individu maupun kelompok. Mahasiswa akan mempelajari berbagai teori dan metode penelitian psikologi, mulai dari psikologi perkembangan, sosial, klinis, hingga industri dan organisasi. Jurusan ini membekali lulusan dengan pemahaman mendalam tentang manusia untuk berkarir sebagai psikolog, konselor, HRD, atau peneliti. Empati dan kemampuan mendengarkan adalah kunci di bidang ini.',
                'img' => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/03/09043035/X-Rekomendasi-Psikolog-Klinis-Berpengalaman-di-Yogyakarta.jpg',
                'video_url' => 'https://www.youtube.com/embed/PLP50TZA4Sc?si=OL-eKf-06qFOD12D',
                'category' => 'Sosial & Humaniora',
                'required_skills' => json_encode(['Empati', 'Kemampuan Mendengar', 'Analisis Perilaku', 'Riset & Statistik', 'Etika Profesional', 'Komunikasi Interpersonal']),
                'career_prospects' => json_encode(['Psikolog Klinis', 'Psikolog Industri & Organisasi', 'Konselor', 'HR Specialist', 'Peneliti', 'Pendidik'])
            ],
            [
                'title' => 'Ilmu Komunikasi',
                'short_desc' => 'Strategi komunikasi dan media.',
                'full_desc' => 'Ilmu Komunikasi mempelajari proses penyampaian pesan secara efektif melalui berbagai media, termasuk periklanan, jurnalisme, dan hubungan masyarakat. Mahasiswa akan mendalami teori komunikasi, produksi media, Public Relations, marketing komunikasi, hingga komunikasi digital. Jurusan ini sangat relevan di era informasi saat ini, mempersiapkan lulusan untuk menjadi komunikator yang handal dan strategis.',
                'img' => 'https://imageio.forbes.com/specials-images/imageserve/6549748a691e87179cfe1c03/Shot-of-a-group-of-diverse-businesspeople-sitting-together-in-a-meeting/960x0.jpg?height=474&width=711&fit=bounds',
                'video_url' => null,
                'category' => 'Sosial & Humaniora',
                'required_skills' => json_encode(['Menulis & Berbicara', 'Analisis Media', 'Riset', 'Kreativitas', 'Public Speaking', 'Adaptasi Digital']),
                'career_prospects' => json_encode(['PR Specialist', 'Jurnalis', 'Content Creator', 'Marketing Communication', 'Media Planner', 'Community Manager'])
            ],
            [
                'title' => 'Sosiologi',
                'short_desc' => 'Mempelajari masyarakat, interaksi sosial, dan budaya.',
                'full_desc' => 'Sosiologi adalah ilmu yang mempelajari struktur sosial, interaksi sosial, dan berbagai fenomena sosial dalam masyarakat. Mahasiswa akan menganalisis isu-isu seperti ketimpangan sosial, perubahan sosial, perilaku kelompok, dan institusi sosial. Jurusan ini melatih kemampuan berpikir kritis dan analitis terhadap kompleksitas kehidupan sosial.',
                'img' => 'https://kuliahdimana.id/public/news/4e963cbcd75235a5956ae511e4286ebb.png',
                'video_url' => null,
                'category' => 'Sosial & Humaniora',
                'required_skills' => json_encode(['Berpikir Kritis', 'Analisis Data Sosial', 'Riset Kualitatif', 'Komunikasi', 'Pemahaman Budaya']),
                'career_prospects' => json_encode(['Peneliti Sosial', 'Analis Kebijakan Publik', 'Pekerja Sosial', 'Konsultan Komunitas', 'HR Specialist'])
            ],
            [
                'title' => 'Hubungan Internasional',
                'short_desc' => 'Dinamika politik, ekonomi, dan sosial global.',
                'full_desc' => 'Jurusan Hubungan Internasional mempelajari interaksi antar negara, organisasi internasional, dan aktor non-negara di panggung global. Ini mencakup isu-isu seperti diplomasi, konflik bersenjata, hukum internasional, ekonomi politik internasional, dan hak asasi manusia. Jurusan ini mempersiapkan lulusan untuk karir di bidang diplomasi, organisasi internasional, think tank, atau jurnalisme global.',
                'img' => 'https://suneducationgroup.com/wp-content/uploads/2020/05/hubungan-internasional-6-1200x900.jpg',
                'video_url' => null,
                'category' => 'Sosial & Humaniora',
                'required_skills' => json_encode(['Analisis Politik', 'Penalaran Kritis', 'Riset Global', 'Kemampuan Bahasa Asing', 'Negosiasi', 'Komunikasi Lintas Budaya']),
                'career_prospects' => json_encode(['Diplomat', 'Analis Intelijen', 'Pegawai Organisasi Internasional', 'Jurnalis Internasional', 'Konsultan Kebijakan'])
            ],

            // Kategori: Kesehatan
            [
                'title' => 'Pendidikan Dokter',
                'short_desc' => 'Studi komprehensif tentang ilmu kedokteran.',
                'full_desc' => 'Pendidikan Dokter adalah program studi yang sangat ketat dan panjang yang mempersiapkan mahasiswa untuk menjadi dokter medis. Kurikulum mencakup ilmu dasar kedokteran, anatomi, fisiologi, farmakologi, patologi, hingga praktik klinis langsung di rumah sakit. Tujuan utamanya adalah menghasilkan dokter yang kompeten, etis, dan mampu memberikan pelayanan kesehatan berkualitas tinggi.',
                'img' => 'https://awsimages.detik.net.id/community/media/visual/2022/02/14/ilustrasi-dokter_169.jpeg?w=600&q=90',
                'video_url' => null,
                'category' => 'Kesehatan',
                'required_skills' => json_encode(['Analisis Ilmiah', 'Dedikasi & Ketahanan', 'Empati', 'Pemecahan Masalah', 'Komunikasi Efektif', 'Kerja Tim']),
                'career_prospects' => json_encode(['Dokter Umum', 'Dokter Spesialis', 'Peneliti Medis', 'Dosen Kedokteran', 'Pegawai Kesehatan Masyarakat'])
            ],
            [
                'title' => 'Ilmu Keperawatan',
                'short_desc' => 'Pemberian asuhan keperawatan holistik kepada pasien.',
                'full_desc' => 'Ilmu Keperawatan mengajarkan keterampilan dan pengetahuan yang dibutuhkan untuk memberikan asuhan keperawatan kepada individu, keluarga, dan komunitas. Ini mencakup promosi kesehatan, pencegahan penyakit, perawatan bagi yang sakit, dan rehabilitasi. Perawat memiliki peran sentral dalam sistem kesehatan, menjadi garda terdepan dalam pelayanan pasien.',
                'img' => 'https://osccdn.medcom.id/images/content/2021/05/26/1ae7e4084b56b70e9bdd0b8d5a930d28.jpg',
                'video_url' => null,
                'category' => 'Kesehatan',
                'required_skills' => json_encode(['Empati', 'Keterampilan Klinis', 'Komunikasi Interpersonal', 'Pemecahan Masalah', 'Ketelitian', 'Stamina Fisik']),
                'career_prospects' => json_encode(['Perawat Klinis', 'Perawat Komunitas', 'Perawat Spesialis', 'Pendidik Keperawatan', 'Peneliti Keperawatan'])
            ],
            [
                'title' => 'Farmasi',
                'short_desc' => 'Pengembangan, produksi, dan distribusi obat-obatan.',
                'full_desc' => 'Farmasi adalah ilmu yang mempelajari tentang obat-obatan, mulai dari penemuan, pengembangan, produksi, hingga distribusi dan penggunaan yang aman dan efektif. Mahasiswa akan mendalami kimia obat, farmakologi, formulasi sediaan, serta aspek regulasi dan etika dalam penggunaan obat. Lulusan farmasi memiliki peran penting dalam memastikan kesehatan masyarakat melalui penggunaan obat yang rasional.',
                'img' => 'https://iik.ac.id/blog/wp-content/uploads/2024/11/farmasi-dan-apoteker.jpeg',
                'video_url' => 'https://www.youtube.com/embed/0X1WjwlhH-s?si=LQN15AN_Exs1FMV-" title="YouTube video player',
                'category' => 'Kesehatan',
                'required_skills' => json_encode(['Kimia', 'Biologi', 'Ketelitian', 'Analisis Data', 'Komunikasi Pasien', 'Pemahaman Regulasi']),
                'career_prospects' => json_encode(['Apoteker', 'Peneliti Obat', 'Quality Control Farmasi', 'Marketing Farmasi', 'Pengajar'])
            ],

            // Kategori: Pendidikan
            [
                'title' => 'Pendidikan Guru Sekolah Dasar (PGSD)',
                'short_desc' => 'Mempersiapkan guru untuk jenjang SD.',
                'full_desc' => 'PGSD adalah program studi yang didesain untuk melatih dan mempersiapkan calon guru yang kompeten dalam mengajar di tingkat Sekolah Dasar. Kurikulum mencakup pedagogi, psikologi perkembangan anak, didaktik-metodik, serta berbagai mata pelajaran dasar seperti Bahasa Indonesia, Matematika, IPA, IPS, dan Seni. Lulusan PGSD akan menjadi pendidik yang mampu menciptakan lingkungan belajar yang menyenangkan dan efektif bagi siswa SD.',
                'img' => 'https://fkip.umsu.ac.id/wp-content/uploads/2023/09/prospek-kerja-lulusan-PGSD-yang-menjanjikan.jpg',
                'video_url' => null,
                'category' => 'Pendidikan',
                'required_skills' => json_encode(['Kesabaran', 'Kreativitas Mengajar', 'Komunikasi Anak', 'Manajemen Kelas', 'Adaptasi Kurikulum', 'Empati']),
                'career_prospects' => json_encode(['Guru SD', 'Pengembang Kurikulum', 'Pendidik Anak Usia Dini', 'Penulis Buku Anak', 'Konsultan Pendidikan'])
            ],
            [
                'title' => 'Pendidikan Bahasa Inggris',
                'short_desc' => 'Mengembangkan kompetensi mengajar bahasa Inggris.',
                'full_desc' => 'Jurusan Pendidikan Bahasa Inggris berfokus pada pengembangan kemampuan berbahasa Inggris (listening, speaking, reading, writing) sekaligus membekali mahasiswa dengan metodologi pengajaran bahasa yang efektif. Kurikulum mencakup linguistik, sastra Inggris, dan praktik mengajar. Lulusan dipersiapkan untuk menjadi guru bahasa Inggris yang profesional di berbagai jenjang pendidikan atau di lembaga kursus.',
                'img' => 'https://maukuliah.ap-south-1.linodeobjects.com/major/1702360961-ckcuemkWCJ.jpg',
                'video_url' => null,
                'category' => 'Pendidikan',
                'required_skills' => json_encode(['Kemampuan Bahasa Inggris', 'Pedagogi', 'Komunikasi', 'Kreativitas Mengajar', 'Pemahaman Budaya']),
                'career_prospects' => json_encode(['Guru Bahasa Inggris', 'Penerjemah', 'Pemandu Wisata', 'Content Writer', 'Pengajar di Lembaga Kursus'])
            ],
        ]);
    }
}
