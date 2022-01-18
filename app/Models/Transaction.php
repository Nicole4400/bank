<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $casts = [
        'id' => 'string'
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    public function payer()
    {
        return $this->belongsTo(AccountHolder::class, 'payer_id');
    }

    public function payee()
    {
        return $this->belongsTo(AccountHolder::class, 'payee_id');
    }
}
