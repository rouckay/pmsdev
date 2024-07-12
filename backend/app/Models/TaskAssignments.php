<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskAssignments extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_id',
        'user_id',
        'assigned_date',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(tasks::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
