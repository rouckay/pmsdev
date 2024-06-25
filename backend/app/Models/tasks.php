<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tasks extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_id',
        'description',
        'assigned_to',
        'percentage',
        'due_date',
        'status',
    ];
    public function project(): BelongsTo
    {
        return $this->belongsTo(projects::class, 'project_id'); // Assuming 'project_id' is the foreign key in the 'tasks' table
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
