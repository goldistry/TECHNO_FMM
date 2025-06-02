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
            [
                'title' => 'Teknik Informatika',
                'short_desc' => 'Mempelajari software, algoritma, dan pemrograman.',
                'full_desc' => 'Jurusan Teknik Informatika mengajarkan bagaimana merancang, mengembangkan, dan memelihara perangkat lunak serta memahami struktur data dan algoritma yang efisien.',
                'img' => 'https://universitasmulia.ac.id/wp-content/uploads/2021/05/ilustrasi-informatics-1030x579.jpg',
                'video_url' => null
            ],
            [
                'title' => 'Desain Komunikasi Visual',
                'short_desc' => 'Visual branding, ilustrasi, dan multimedia.',
                'full_desc' => 'Jurusan ini mengajarkan cara mengomunikasikan pesan melalui elemen visual seperti grafis, tipografi, warna, dan media interaktif.',
                'img' => 'https://dkv.fkip.um-surabaya.ac.id/assets/img/news_img/11558e19-a1df-11ed-a993-000c29cc32a6_beritadkv3.png',
                'video_url' => null
            ],
            [
                'title' => 'Manajemen Bisnis',
                'short_desc' => 'Strategi, pemasaran, dan keuangan bisnis.',
                'full_desc' => 'Jurusan Manajemen Bisnis mengajarkan perencanaan, pengorganisasian, dan pengelolaan sumber daya untuk mencapai tujuan bisnis secara efektif.',
                'img' => 'https://mvnu.edu/content/uploads/2024/01/mvnu-online-difference-between-admin-and-business-management.jpeg.webp',
                'video_url' => null
            ],
            [
                'title' => 'Psikologi',
                'short_desc' => 'Perilaku manusia dan kesehatan mental.',
                'full_desc' => 'Psikologi membahas aspek mental, emosional, dan perilaku manusia, baik secara individu maupun kelompok.',
                'img' => 'https://d1vbn70lmn1nqe.cloudfront.net/prod/wp-content/uploads/2022/03/09043035/X-Rekomendasi-Psikolog-Klinis-Berpengalaman-di-Yogyakarta.jpg',
                'video_url' => null
            ],
            [
                'title' => 'Arsitektur',
                'short_desc' => 'Desain bangunan dan ruang.',
                'full_desc' => 'Jurusan Arsitektur menggabungkan seni dan sains untuk merancang bangunan dan ruang yang fungsional, estetis, dan berkelanjutan.',
                'img' => 'https://www.linovhr.com/wp-content/uploads/2023/03/arsitek-adalah.webp',
                'video_url' => null
            ],
            [
                'title' => 'Ilmu Komunikasi',
                'short_desc' => 'Strategi komunikasi dan media.',
                'full_desc' => 'Ilmu Komunikasi mempelajari proses penyampaian pesan secara efektif melalui berbagai media, termasuk periklanan, jurnalisme, dan hubungan masyarakat.',
                'img' => 'https://imageio.forbes.com/specials-images/imageserve/6549748a691e87179cfe1c03/Shot-of-a-group-of-diverse-businesspeople-sitting-together-in-a-meeting/960x0.jpg?height=474&width=711&fit=bounds',
                'video_url' => null
            ],
        ]);
    }
}
