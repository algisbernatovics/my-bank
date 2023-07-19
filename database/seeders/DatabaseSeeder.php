<?php

namespace Database\Seeders;


use App\Models\Accounts;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
//        User::factory(10)->create();
        Accounts::factory(10)->create();
    }
}

