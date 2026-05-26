<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($id = 0; $id <= 3; $id++) { 
            DB::table('users')->insert([
                'name' => 'User' . $id,
                'email' => 'user_' . $id . '@gmail.com',
                'password' => bcrypt('user' . $id),
                'email_verified_at' => now(),
                'created_at' => now()
            ]);
        }
    }
}
