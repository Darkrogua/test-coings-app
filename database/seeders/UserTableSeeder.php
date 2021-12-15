<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'name'              =>  'Admin',
            'email'             =>  '1@admin.ru',
            'email_verified_at' =>  now(),
            'password'          =>  bcrypt('admin'),
            'remember_token'    =>  Str::random(10)
        ];

        \DB::table('users')->insert($user);
    }
}
