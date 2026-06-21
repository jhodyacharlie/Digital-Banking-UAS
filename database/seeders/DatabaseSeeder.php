<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'no_card' => '1234567890',
                'password' => 'password',
                'balance' => 12500000,
            ]
        );

        User::updateOrCreate(
            ['email' => 'jhodya@jhodya'],
            [
                'name' => 'Charlie',
                'no_card' => '111222333444',
                'password' => '133345',
                'balance' => 12500000,
            ]
        );
    }
}
