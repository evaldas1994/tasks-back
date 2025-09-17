<?php

namespace Database\Seeders;

use App\Models\SystemParameter;
use Illuminate\Database\Seeder;

class SystemParamSeeder extends Seeder
{
    public function run(): void
    {
        if (SystemParameter::count() > 0)
            return;

        $data = $this->getData();

        foreach ($data as $item) {
            SystemParameter::create($item);
        }
    }

    private function getData(): array
    {
        return [
            [
                'key' => 'job_counter',
                'type' => 'int',
                'value' => 0,
            ],
        ];
    }
}
