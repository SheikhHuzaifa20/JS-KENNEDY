<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BannerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BannerSeeder::class);
        // $this->call(SectionSeeder::class);
    }
}
