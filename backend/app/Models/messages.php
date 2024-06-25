<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'group_id',
        'content',
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function group(): BelongsTo
    {
        return $this->belongsTo(groups::class, 'group_id');
    }
}
