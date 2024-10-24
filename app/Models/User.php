<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Ajoutez la propriété `last_activity_at` ici
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'password',
        'last_activity_at', // Ajoutez cette ligne
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
        'last_activity_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isOnline(): bool
    {
        return $this->last_activity_at && $this->last_activity_at->greaterThan(now()->subMinutes(5));
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasRole($role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
}
