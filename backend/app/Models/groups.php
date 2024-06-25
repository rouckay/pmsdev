<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class groups extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(projects::class);
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
