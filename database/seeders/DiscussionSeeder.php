<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Discussion;
use App\Models\User;
use Faker\Factory as Faker;

class DiscussionSeeder extends Seeder
{
    public function run()
    {
        // Pastikan ada minimal 5 user untuk assign diskusi
        if (User::count() < 5) {
            User::factory()->count(5)->create();
        }
        $users = User::pluck('id')->all();

        // Topik diskusi yang lebih "masuk akal"
        $topics = [
            [
                'title'    => 'Bagaimana prospek karir lulusan Teknik Informatika?',
                'category' => 'Teknik',
                'content'  => 'Saya ingin tahu prospek kerja dari lulusan Teknik Informatika di industri startup dan korporasi besar.  
                               Apakah spesialisasi di AI atau cloud computing lebih menjanjikan?',
            ],
            [
                'title'    => 'Pengalaman magang di rumah sakit sebagai mahasiswa Keperawatan',
                'category' => 'Kesehatan',
                'content'  => 'Halo teman-teman, siapa yang sudah pernah magang di rumah sakit swasta?  
                               Ceritain dong kendala dan tipsnya, khususnya bagian ICU.',
            ],
            [
                'title'    => 'Tips mengatur keuangan saat kuliah jurusan Ekonomi',
                'category' => 'Ekonomi',
                'content'  => 'Saya kesulitan membagi waktu antara organisasi kampus dan freelance sebagai tutor ekonomi.  
                               Bagaimana cara mengelola keuangan dan waktu agar tetap seimbang?',
            ],
            [
                'title'    => 'Perbedaan antara Teknik Sipil dan Teknik Arsitektur?',
                'category' => 'Teknik',
                'content'  => 'Apakah benar Teknik Sipil lebih fokus struktur bangunan, sedangkan Arsitektur lebih ke desain?  
                               Bagi yang sudah ambil mata kuliah dasar, share pengalaman kalian.',
            ],
            [
                'title'    => 'Kurikulum terbaru Farmasi: apa saja yang berubah?',
                'category' => 'Kesehatan',
                'content'  => 'Saya baca ada update kurikulum 2024 untuk Farmasi.  
                               Ada yang bisa jelaskan tambahan mata kuliah laboratorium apa saja?',
            ],
            [
                'title'    => 'Manfaat sertifikasi ekonomi digital untuk fresh graduate',
                'category' => 'Ekonomi',
                'content'  => 'Apakah sertifikasi seperti Google Analytics atau Digital Marketing  
                               benar-benar membantu mencari pekerjaan di bidang ekonomi?',
            ],
        ];

        foreach ($topics as $t) {
            Discussion::create([
                'user_id'    => array_rand(array_flip($users)),
                'title'      => $t['title'],
                'content'    => $t['content'],
                'category'   => $t['category'],
                // likes_count & comments_count default = 0
            ]);
        }
    }
}
