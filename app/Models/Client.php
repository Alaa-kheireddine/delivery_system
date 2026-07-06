<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = [
        'name',
        'code',
        'contact_person_name',
        'phone',
        'email',
        'city',
        'address',
        'client_id',
        'branch_id',
        'default_delivery_fee',
        'current_balance',
        'total_client_earnings',
        'total_paid_amount',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'delivery_fee' => 'decimal:2',
        'current_balance' => 'decimal:2',
        'total_client_earnings' => 'decimal:2',
        'total_paid_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];


    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    // he lal future, bikoun kl cherke fi aktr mn user tebe3la(owner, managment, staff1, staff2..)
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(ClientPayment::class);
    }
}
