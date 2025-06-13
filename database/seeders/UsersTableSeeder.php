<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Seeder: UsersTableSeeder
 *
 * Inserts predefined users into the 'users' table for testing and development purposes.
 * 
 * Created users:
 *  - Demo User: demo@latinad.com / 12345678
 *  - Test User: test@latinad.com / password123
 *
 * The passwords are securely hashed using Laravel's Hash facade.
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Demo User',
                'email' => 'demo@latinad.com',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'test@latinad.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
