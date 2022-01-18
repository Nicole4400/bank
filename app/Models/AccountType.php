<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $casts = [
        'id' => 'string'
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function accountHolders()
    {
        return $this->hasMany(AccountHolder::class);
    }

    public function accountPermissions()
    {
        return $this->belongsToMany(AccountPermission::class);
    }
}
