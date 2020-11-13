<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Zami',
            'email' => 'zamsyh.work@gmail.com',
            'password' => bcrypt('zami123'),
            'api_token' => sha1('zamsyh.work@gmail.com')
        ]);
    }
}
