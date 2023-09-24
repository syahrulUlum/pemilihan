<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Siswa;
use App\Models\Staff;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    //     \App\Models\User::factory()->create([
    //         'name' => 'Administrator',
    //         'username' => 'admin',
    //         'password' => Hash::make('admin'),
    //     ]);
        Siswa::factory(15)->create();
        // Staff::factory(5)->create();
    }
}
