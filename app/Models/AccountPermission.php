<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountPermission extends Model
{
    public const TRANSFER_ACTION = 'transfer';
    public const RECEIVE_ACTION = 'receive';

    protected $casts = [
        'id' => 'string'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function accountTypes()
    {
        return $this->belongsToMany(AccountType::class);
    }
}
