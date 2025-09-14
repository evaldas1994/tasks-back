<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (User::count() > 0)
            return;

        $data = $this->getData();

        foreach ($data as $item) {
            User::create($item);
        }
    }

    private function getData(): array
    {
        return [
            [
                'name' => 'Evaldas',
                'email' => 'evaldas@titobu.dev',
                'password' => Hash::make('000000'),
                'pwa_project_code' => 'if',
            ],
            [
                'name' => 'Jūratė',
                'email' => 'jurate@titobu.dev',
                'password' => Hash::make('111111'),
                'pwa_project_code' => 'ulala',
            ],
        ];
    }
}
