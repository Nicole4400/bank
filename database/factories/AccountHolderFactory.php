<?php

namespace Database\Factories;

use App\Models\AccountType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountHolderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'id'   => Str::uuid(),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'salt' =>  Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function cpf()
    {
        return $this->state(function (array $attributes) {
            return [
                'document' => str_pad(mt_rand(1, 99999999999), 11, '0'),
                'account_type_id' => AccountType::where('name', 'customer')->first()
            ];
        });
    }

    public function cnpj()
    {
        return $this->state(function (array $attributes) {
            return [
                'document' => str_pad(mt_rand(1, 99999999999), 14, '0'),
                'account_type_id' => AccountType::where('name', 'seller')->first()
            ];
        });
    }
}
