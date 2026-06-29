<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@etixis.com'],
            [
                'name' => 'Admin E-TIXIS',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@etixis.com'],
            [
                'name' => 'User E-TIXIS',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        );

        User::updateOrCreate(
            ['email' => 'petugas@etixis.com'],
            [
                'name' => 'Petugas E-TIXIS',
                'password' => Hash::make('password'),
                'role' => 'petugas',
            ]
        );
    }
}