<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'freeze',
    ];

    protected $casts = [
        'week_days' => 'json',
    ];





    // ---------- Objekto metodai ----------
    public function addStreak(): void
    {
        $this->streak++;
        if ($this->streak > $this->streak_max) {
            $this->streak_max = $this->streak;
        }
        $this->save();
    }
    public function resetStreak(): void
    {
        $this->streak = 0;
        $this->save();
    }

    public function useFreeze(): void
    {
        $this->freeze = $this->freeze - 1;
        $this->save();
    }





    // ---------- Query Scope ----------
    public function scopeForOwnerOrderedByStreak($query, $userId): Builder
    {
        return $query->where('user_id', $userId)
            ->orderByDesc('streak');
    }





    // ---------- Ryšiai ----------
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
