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
        'must_change_password',
        'temporary_password_expires_at',
        'password_changed_at',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
        'salary' => 'decimal:2',
        'must_change_password' => 'boolean',
        'temporary_password_expires_at' => 'datetime',
        'password_changed_at' => 'datetime',
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
    public function hasRole(string $role){
        return $this->role?->name === $role;
    }

    public function scopeVisibleTo($query, User $authUser)
    {
        if ($authUser->role->name === 'admin') {
            return $query->whereHas('role', function ($q) {
                $q->where('name', '!=', 'admin');
            });
        }

        if ($authUser->role->name === 'manager') {
            return $query
                ->where('branch_id', $authUser->branch_id)
                ->whereHas('role', function ($q) {
                    $q->whereNotIn('name', ['admin', 'manager']);
                });
        }

        return $query->where('id', $authUser->id);
    }

}
