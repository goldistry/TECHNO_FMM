<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MajorSeeder::class,
<<<<<<< HEAD
=======
            CategoriesQuestionsSeeder::class,
>>>>>>> 0a7de8735cd3d3a6bef56ec649323bcd3b01ae43
        ]);
    }
}
