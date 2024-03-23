<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $users = [
            [
                'name' => 'Algis',
                'surname' => 'Bernatovics',
                'personal_code' => '123000-00000',
                'email' => 'algis.bernatovics@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'John',
                'surname' => 'Doe',
                'personal_code' => '456000-00000',
                'email' => 'jd@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            $userData['created_at'] = now();
            $userData['updated_at'] = now();
            DB::table('users')->insert($userData);
        }
    }

}

