<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'due_date',
        'status',
        'image_path',
        'progress',
        'created_by',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
