<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->updateOrInsert(
            ['id' => 2],
            [
                'title' => 'Slider Two',
                'description' => '
                <h1 class="typingheading">Green Dragon Audio </h1>
                <p>Tantor Media is proud to take on Green Dragon, Book Five of the Mackenzie Green series. Narrated by the talented Justine Eyre, the audio book will be available through all regular retailers on November 4th, 2025.</p>',
                'link' => 'https://rbmediaglobal.com/audiobook/9798318525568/',
                'updated_at' => now(),
            ],
        );

        DB::table('banners')->updateOrInsert(
            ['id' => 3],
            [
                'title' => 'Slider Three',
                'description' => '
                   <h1 class="typingheading">Green Dragon </h1>
                <p>Green Dragon, Book Five of the Mackenzie Green series, is now available on Amazon. Free with your Kindle Unlimited subscription, read the epic conclusion to a series with over 12,000 five-star reviews.</p>',
                'updated_at' => now(),
            ],
        );
        DB::table('banners')->updateOrInsert(
            ['id' => 4],
            [
                'status' => 'deactive',
                'updated_at' => now(),
            ],
        );
        DB::table('banners')->updateOrInsert(
            ['id' => 5],
            [
                'title' => 'Slider Five',
                'description' => '
                 <h1 class="typingheading">In the Works!</h1>
                <p>Tyr’s adventure – (Spoilers) Wonder what happened to Tyr after Tan spirited him away at the end of Green Vampire Four. Find out in the upcoming novel by JS Kennedy set to release in 2026.</p>',
                'updated_at' => now(),
            ],
        );
        DB::table('banners')->updateOrInsert(
            ['id' => 6],
            [
                'title' => 'Slider Six',
                'description' => '
                <h1 class="typingheading">Dive into your next favorite series</h1>
                <p>Do you enjoy a world where magic reigns and technology is long lost? Do you melt with found families who would go to the end of the world for each other? Do you have a hankering for a slow-burn romance with a female lead who won’t settle for anything less? Join thousands of readers. With over 12,000 5 star reviews. Mackenzie and her crew might just be the escape you’re looking for.</p>',
                'updated_at' => now(),
            ],
        );
    }
}
