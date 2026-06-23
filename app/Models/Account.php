<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'account_number',
        'account_name',
        'account_type',
        'status',
    ];

    protected $table = 'accounts';

    public function balance()
    {
        return $this->hasOne(Balance::class);
    }
}
