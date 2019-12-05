<?php

use App\User;
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
        $users = [
            [
                'fname' => 'Administrator',
                'lname' => 'Administrator',
                'mname' => 'Administrator',
                'contact' => '1234567899',
                'email' => 'admin@email.com',
                'password' => Hash::make('admin'),
                'isAdmin' => true,
            ],
            [
                'fname' => 'Human',
                'mname' => null,
                'lname' => 'Resource',
                'contact' => '1234567899',
                'email' => 'humanresource@email.com',
                'password' => Hash::make('humanresource'),
                'isHR' => true,
            ],

        ];
        foreach($users as $user) {
            User::create($user);
        }
    }
}
