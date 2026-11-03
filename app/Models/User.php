<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Proyectos creados por el usuario
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    // Proyectos en los que participa el usuario
    public function participatingProjects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)->withPivot('role', 'contribution_hours')->withTimestamps();
    }
}
