<?php

namespace Database\Factories;

use App\Models\AccountHolder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' =>  Str::uuid(),
            'balance' => (mt_rand(1, 1000000) - mt_rand(1, 1000000)) / 100,
            'account_holder_id' => AccountHolder::factory()
        ];
    }

    public function cpf()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_holder_id' => AccountHolder::factory()->cpf()
            ];
        });
    }

    public function cnpj()
    {
        return $this->state(function (array $attributes) {
            return [
                'account_holder_id' => AccountHolder::factory()->cnpj()
            ];
        });
    }
}
