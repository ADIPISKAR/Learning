<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'full_name' => 'Test User',
            'birth_date' => '2000-01-01',
            'phone' => '+79991234567',
            'email' => 'test@example.com',
            'login' => 'testuser',
            'password' => Hash::make('password'),
            'photo' => null,
        ]);

        User::create([
            'full_name' => 'Alice Smith',
            'birth_date' => '1995-05-15',
            'phone' => '+79997654321',
            'email' => 'alice@example.com',
            'login' => 'alice',
            'password' => Hash::make('password'),
            'photo' => null,
        ]);
    }
}
