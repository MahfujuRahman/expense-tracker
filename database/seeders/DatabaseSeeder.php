<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::truncate();
        \DB::table('categories')->truncate();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);

        // Seed default categories
     \DB::table('categories')->insert([
            ['name' => 'Food'],
            ['name' => 'Transport'],
            ['name' => 'Shopping'],
            ['name' => 'Others'],
        ]);
    }
}
