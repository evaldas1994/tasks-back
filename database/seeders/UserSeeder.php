<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() === 0) {
            User::insert([
                'name' => 'Evaldas', 'email' => 'evaldas.tuleikis@gmail.com', 'password' => Hash::make('000000'),
            ]);
        }
    }
}
