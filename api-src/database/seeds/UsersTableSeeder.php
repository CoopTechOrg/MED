<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::insert([
            'name' => 'test user',
            'email' => 'hoge@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
        ]);
    }
}
