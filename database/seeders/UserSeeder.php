<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'mohamed',
            'email' => 'mohamed@graspstudios.co',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->count(3)->create();
    }
}
