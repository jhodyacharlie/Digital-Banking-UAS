<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'account_id',
        'amount',
        'last_transaction_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'last_transaction_at' => 'datetime',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
