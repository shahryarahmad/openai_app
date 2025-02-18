<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => '12345678'
        ]);
        User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => '12345678'
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        DB::table('roles')->insert([
            'name' => 'user',
        ]);

        DB::table('role_user')->insert([
            'user_id' => '1',
            'role_id' => '1'
        ]);
      

    }
}
