<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Status::count() === 0) {
            Status::insert([
                ['name' => 'Nepradėta'],
                ['name' => 'Vykdoma'],
                ['name' => 'Atlikta'],
                ['name' => 'Neatlikta'],
            ]);
        }
    }
}
