<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'city',
        'address',
        'phone',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function shipments(){
        return $this->hasMany(Shipment::class);
    }

    public function scopeVisibleToUser(Builder $query, User $user){
        if($user->role?->name === 'admin'){
            return $query;
        }
        return $query->where("id", $user->branch_id);
    }

}
