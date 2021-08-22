<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            ImageSeeder::class,
            NewsSeeder::class,
            ProjectServiceSeeder::class,
            InquirySeeder::class
        ]);
    }
}
