<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->belongsToMany(User::class, 'project_user')->withPivot('role', 'contribution_hours')->withTimestamps();
    }
}