<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        \App\Models\User::factory()->create([
            'name' => 'Root User :: Developer',
            'email' => 'super@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Pa$$w0rd!'), // Pa$$w0rd!
            'remember_token' => Str::random(10),
        ]);
    }
}