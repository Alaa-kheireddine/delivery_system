<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Policies\TestUsersPolicy;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'salary',
        'is_active',
        'branch_id',
        'role_id',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
        'salary' => 'decimal:2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasPermission(string $permission){ 
        return $this->role->permissions()->where('name', $permission)->exists();
    }
}
