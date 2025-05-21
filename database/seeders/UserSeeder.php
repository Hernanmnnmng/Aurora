<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@aurora.nl',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Medewerker User',
            'email' => 'medewerker@aurora.nl',
            'password' => Hash::make('password'),
            'role' => 'medewerker',
        ]);

        User::create([
            'name' => 'Bezoeker User',
            'email' => 'bezoeker@aurora.nl',
            'password' => Hash::make('password'),
            'role' => 'bezoeker',
        ]);
    }
}