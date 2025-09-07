<?php

namespace Database\Seeders;

use App\Models\TaskTemplate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskTemplateSeeder extends Seeder
{
    public function run(): void
    {
        if (TaskTemplate::count() > 0)
            return;

        $data = $this->getData();

        foreach ($data as $item) {
            TaskTemplate::create($item);
        }
    }

    private function getData(): array
    {
        return [
            [
                'name' => 'Rytas',
                'description' => 'Reguliariai keltis visomis dienomis',
                'user_id' => User::first()->id,
                'week_days' => [1, 2, 3, 4, 5, 6, 7],
                'time' => '05:45',
                'duration_in_minutes' => 5,
                'streak' => 0,
                'streak_max' => 0,
            ],
            [
                'name' => 'Sporto klubas',
                'description' => 'Reguliariai nueiti pasportuoti bent tris kartus per savaitę',
                'user_id' => User::first()->id,
                'week_days' => [1, 3, 5],
                'time' => '06:00',
                'duration_in_minutes' => 90,
                'streak' => 0,
                'streak_max' => 0,
            ],
            [
                'name' => 'Projektas',
                'description' => 'Po labai mažą dalį reguliariai įgyvendinti projektą',
                'user_id' => User::first()->id,
                'week_days' => [2, 4, 6, 7],
                'time' => '06:00',
                'duration_in_minutes' => 90,
                'streak' => 0,
                'streak_max' => 0,
            ],
            [
                'name' => 'Mokymasis',
                'description' => 'Gilinimasis į programavimą / kurai',
                'user_id' => User::first()->id,
                'week_days' => [1, 2, 3, 4, 5],
                'time' => '20:00',
                'duration_in_minutes' => 90,
                'streak' => 0,
                'streak_max' => 0,
            ],
            [
                'name' => 'Knyga',
                'description' => 'Reguliariai skaityti bent 30 min per dieną',
                'user_id' => User::first()->id,
                'week_days' => [1, 3, 5, 6, 7],
                'time' => '21:30',
                'duration_in_minutes' => 30,
                'streak' => 0,
                'streak_max' => 0,
            ],
            [
                'name' => 'Dokumentacija',
                'description' => 'Dokumentuoti savo projektus pagal susikaupusius užrašus',
                'user_id' => User::first()->id,
                'week_days' => [2, 4],
                'time' => '21:30',
                'duration_in_minutes' => 30,
                'streak' => 0,
                'streak_max' => 0,
            ],
        ];
    }
}
