<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_template_id',
        'status_id',
    ];

    public function taskTemplate()
    {
        return $this->belongsTo(TaskTemplate::class, 'task_template_id');
    }

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
}
