<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    public function accountHolder()
    {
        return $this->belongsTo(AccountHolder::class);
    }
}
