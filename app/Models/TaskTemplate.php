<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'week_days',
        'time',
        'duration_in_minutes',
        'streak',
        'streak_max',
    ];

    protected $casts = [
        'week_days' => 'json',
    ];

    public function addStreak() {
        $this->streak = $this->streak + 1;

        if ($this->streak > $this->streak_max)
            $this->streak_max = $this->streak;

        $this->save();
    }

    public function resetStreak() {
        $this->streak = 0;
        $this->save();
    }

    public static function forOwnerOrderedByStreak()
    {
        return self::where('user_id', auth()->id())
            ->orderByDesc('streak')
            ->get();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
