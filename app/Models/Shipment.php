<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tracking_number',

        'branch_id',
        'created_by',
        'delivery_agent_id',
        'current_branch_id',
        'destination_branch_id',

        'receiver_name',
        'receiver_phone',
        'receiver_city',
        'receiver_address',

        'description',

        'delivery_fee',
        'cod_amount',
        'payment_status',
        'status',

        'notes',
    ];

    protected $casts = [
        'delivery_fee' => 'decimal:2',
        'cod_amount' => 'decimal:2',
        'deleted_at' => 'datetime',
    ];


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function deliveryAgent()
    {
        return $this->belongsTo(User::class, 'delivery_agent_id');
    }

    public function currentBranch()
    {
        return $this->belongsTo(Branch::class, 'current_branch_id');
    }

    public function destinationBranch()
    {
        return $this->belongsTo(Branch::class, 'destination_branch_id');
    }


    public function needsTransfer(): bool
    {
        return $this->current_branch_id !== null
            && $this->destination_branch_id !== null
            && $this->current_branch_id !== $this->destination_branch_id;
    }

    public function isDelivered(): bool
    {
        return $this->status === 'delivered';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isReturned(): bool
    {
        return $this->status === 'returned';
    }

    public function isFinished(): bool
    {
        return in_array($this->status, [
            'delivered',
            'cancelled',
            'returned',
        ], true);
    }

    public function isPaymentPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    public function isPaymentCollected(): bool
    {
        return $this->payment_status === 'collected';
    }

    public function isPaymentSettled(): bool
    {
        return $this->payment_status === 'settled';
    }
}