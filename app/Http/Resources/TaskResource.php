<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->taskTemplate?->name,
            'description' => $this->taskTemplate?->description,
            'time' => $this->taskTemplate?->time,
            'duration_in_minutes' => $this->taskTemplate?->duration_in_minutes,
            'streak' => $this->taskTemplate?->streak,
        ];
    }
}
