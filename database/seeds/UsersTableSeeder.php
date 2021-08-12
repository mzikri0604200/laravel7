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
        \App\User::create([
            'name' => 'kiki',
            'username' => 'kiki123',
            'password' => bcrypt('password'),
            'email' => 'kiki@admin.com',
        ]);
    }
}
