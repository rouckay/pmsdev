<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'priority',
        'image_path',
        'status',
        'assigned_to',
        'user_id',
        'update_by',
        'project_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Projects::class);
    }

    public function userAgent(): BelongsTo
    {
        return $this->belongsTo(User::class, );
    }
}
