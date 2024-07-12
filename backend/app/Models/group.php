<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model // Use singular form for model name
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'user_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(projects::class); // Ensure correct model name
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class); // Ensure correct model name and foreign key
    }
}
