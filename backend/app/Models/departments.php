<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class departments extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
    ];
    public function Project(): BelongsTo
    {
        return $this->belongsTo(projects::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(companies::class);
    }

}
