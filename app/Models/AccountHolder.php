<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHolder extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class);
    }

    public function payerTransactions()
    {
        return $this->hasMany(Transaction::class, 'payer_id', 'id');
    }

    public function payeeTransactions()
    {
        return $this->hasMany(Transaction::class, 'payee_id', 'id');
    }
}
