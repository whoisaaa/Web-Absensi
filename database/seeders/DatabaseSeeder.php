<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Existing dosen account
        \App\Models\User::create([
            'name' => 'Dosen Budi',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('password123'),
        ]);

        // Additional dosen account
        \App\Models\User::create([
            'name' => 'Dosen Siti',
            'email' => 'dosen2@gmail.com',
            'password' => bcrypt('password123'),
        ]);
    }
}
