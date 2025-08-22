<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            User::create([
        'name' => 'Taha',
        'email' => 'taha@admin.com',
        'email_verified_at' => now(),
        'password' => Hash::make('admin123'),
        'remember_token' => Str::random(10),
        'is_admin' => true,
    ]);
    }
}
