<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class group_members extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'user_id',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(groups::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
