<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class resources extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'resource_type',
        'quantity',
    ];

    public function Project(): BelongsTo
    {
        return $this->belongsTo(projects::class);
    }

}
