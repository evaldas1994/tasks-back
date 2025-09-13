<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_template_id',
        'status_id',
        'term_at',
    ];







    // ---------- Objekto metodai ----------
    public function setCompleted()
    {
        $this->status_id = 3;
        $this->save();
    }
    public function setUncompleted()
    {
        $this->status_id = 4;
        $this->save();
    }
    public static function isAlreadyCreated(int $taskTemplateId, string $date): bool
    {
        return static::query()->where('task_template_id', $taskTemplateId)
            ->whereBetween('term_at', [
                Carbon::parse($date)->startOfDay(),
                Carbon::parse($date)->endOfDay(),
            ])
            ->exists();
    }




    // ---------- Query Scope ----------
    public function scopeIndex($query, int $userId, string $date): Builder
    {
        return $query->with('taskTemplate')
            ->whereHas('taskTemplate', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->whereIn('status_id', [1,2]);
    }
    public function scopeForAutoClose($query, string $date): Builder
    {
        return $query->whereIn('status_id', [1,2])
            ->whereBetween('term_at', [
                Carbon::parse($date)->startOfDay(),
                Carbon::parse($date)->endOfDay(),
            ]);
    }




    // ---------- Ryšiai ----------
    public function taskTemplate()
    {
        return $this->belongsTo(TaskTemplate::class, 'task_template_id');
    }
}
