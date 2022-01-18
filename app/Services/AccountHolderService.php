<?php

namespace App\Services;

use App\Models\AccountHolder;

class AccountHolderService
{
    public function hasBalance(string $id, float $value): bool
    {
        $accountHolder = AccountHolder::with('account')->find($id);
        return $accountHolder->account->balance >= $value;
    }

    public function can(string $id, string $action): bool
    {
        $accountHolder = AccountHolder::with('accountType.accountPermissions')->find($id);

        return $accountHolder->accountType->accountPermissions->contains('action', $action);
    }
}
