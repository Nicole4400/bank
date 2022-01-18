<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\AccountHolder;
use App\Models\AccountPermission;
use App\Models\AccountType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seller = new AccountType([
            'id' => Str::uuid(),
            'name' =>  'seller'
        ]);
        $customer = new AccountType([
            'id' => Str::uuid(),
            'name' =>  'customer'
        ]);

        $transferPermission = new AccountPermission([
            'id' =>  Str::uuid(),
            'action' => AccountPermission::TRANSFER_ACTION,
            'description' => 'Permission to transfer money to other accounts'
        ]);
        $receivePermission = new AccountPermission([
            'id' =>  Str::uuid(),
            'action' => AccountPermission::RECEIVE_ACTION,
            'description' => 'Permission to receive money from other accounts'
        ]);
        $transferPermission->save();
        $receivePermission->save();

        $seller->accountPermissions()->sync([
            $receivePermission->id
        ]);
        $customer->accountPermissions()->sync([
            $receivePermission->id,
            $transferPermission->id
        ]);

        $customer->save();
        $seller->save();

        Account::factory()->count(20)->cpf()->create();
        Account::factory()->count(20)->cnpj()->create();


        // \App\Models\User::factory(10)->create();
    }
}
