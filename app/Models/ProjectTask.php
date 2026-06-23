<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id',
        'assigned_to',
        'name',
        'description',
        'start_date',
        'end_date',
        'estimated_hours',
        'actual_hours',
        'priority',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'estimated_hours' => 'decimal:2',
            'actual_hours' => 'decimal:2',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function dependencies(): HasMany
    {
        return $this->hasMany(ProjectTaskDependency::class, 'task_id');
    }

    public function dependedBy(): HasMany
    {
        return $this->hasMany(ProjectTaskDependency::class, 'dependency_id');
    }
}
