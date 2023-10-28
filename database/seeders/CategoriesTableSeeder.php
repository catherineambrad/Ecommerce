<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'VR Covers', 'user_id' => 1],
            ['name' => 'VR Gloves', 'user_id' => 1],
            ['name' => 'Full Body Tracker', 'user_id' => 1],
            ['name' => 'VR Lenses', 'user_id' => 1],
            ['name' => 'Googly Eyes', 'user_id' => 1],
            ['name' => 'Grip Covers with Knuckle Strap', 'user_id' => 1],
            ['name' => 'External Battery Pack', 'user_id' => 1],
            ['name' => 'Headset Stand', 'user_id' => 1],
            ['name' => 'Long USB C Cord', 'user_id' => 1],
            ['name' => 'VR Gun Stock', 'user_id' => 1],
            ['name' => 'Headset Strap Pads', 'user_id' => 1],
            ['name' => 'Table Tennis Paddle Grip', 'user_id' => 1],
        ]);
    }
}
