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
        User::factory()->count(4)->create();
    /*
        \App\Models\User::create([
            'name' => 'supremo',
            'email' => 'User@example.com',
            'password' => bcrypt('123'),
            'role' => 'admin',
            'genitor' => true,
        ]);
    */
    }
}
