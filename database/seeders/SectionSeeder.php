<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('section')->insert([
            [
                'label' => 'Section Prescription Headings',
                'slug' => 'section_prescription_headings',
                'type' => 'textarea',
                'value' => '<h2>Free</h2>
                            <h3>PRESCRIPTION SAVINGS</h3>',
                'page_id' => 33,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'label' => 'Section Prescription Link Text',
                'slug' => 'section_prescription_link',
                'type' => 'text',
                'value' => 'CLICK HERE FOR FREE RX CARD',
                'page_id' => 33,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
