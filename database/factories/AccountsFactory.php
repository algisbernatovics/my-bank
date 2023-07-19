<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccountsFactory extends Factory
{
    public function definition()
    {

        sleep('1');

        return [
            'user_id' => 1,
            'currency' => 'GBP',
            'type' => 'Standard',
            'acc_number' => strtoupper(md5('000000-00000' . date('r') . time()))
        ];
    }
}
