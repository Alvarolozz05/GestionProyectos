<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'title', 'description', 'due_date', 'status'];

    protected function casts(): array
    {
        return ['due_date' => 'date'];
    }

    // Usuario propietario del proyecto
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Usuarios participantes del proyecto
    public function participants(): BelongsToMany
    {
        return $this-belongsToMany('role', 'contribution_hours')->withTimestamps();
    }
}