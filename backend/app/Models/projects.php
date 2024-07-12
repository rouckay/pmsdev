<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'department_id'
    ];

    public function Resources(): HasMany
    {
        return $this->hasMany(Resource::class);
    }

    public function department(): HasMany
    {
        return $this->hasMany(Departments::class);
    }

}
