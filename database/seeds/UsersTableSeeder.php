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
        factory(\Invoicing\User::class)->create([
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);
    }
}
