<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class file_sharing extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'user_id',
        'document_url',
        'message',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(projects::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
