<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Seeder: DatabaseSeeder
 *
 * Main entry point for seeding the application's database.
 *
 * Seeders executed:
 * - UsersTableSeeder: inserts sample users for authentication and testing.
 * - DisplaysTableSeeder: inserts sample displays linked to users.
 *
 * This file allows consistent database initialization for development and testing environments.
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            DisplaysTableSeeder::class,
        ]);
    }
}
