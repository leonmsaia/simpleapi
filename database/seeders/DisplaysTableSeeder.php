<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Seeder: DisplaysTableSeeder
 *
 * Inserts predefined displays into the 'displays' table for testing purposes.
 * 
 * Each display is associated with an existing user (user_id = 1).
 *
 * Inserted displays:
 *  - Outdoor Screen 1: Large outdoor advertising screen.
 *  - Indoor Screen A: Small indoor screen for events.
 *
 * The inserted data allows validating the displays CRUD endpoints.
 */
class DisplaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('displays')->insert([
            [
                'name' => 'Outdoor Screen 1',
                'description' => 'Large outdoor advertising screen.',
                'price_per_day' => 150.00,
                'resolution_height' => 1080,
                'resolution_width' => 1920,
                'type' => 'outdoor',
                'user_id' => 1, // Demo User
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Indoor Screen A',
                'description' => 'Small indoor screen for events.',
                'price_per_day' => 75.50,
                'resolution_height' => 720,
                'resolution_width' => 1280,
                'type' => 'indoor',
                'user_id' => 1, // Demo User
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
