<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

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
                'role_id' => 1,
                'username' => 'admin',
                'password' => bcrypt('secret'),
                'email' => 'admin@mail.com',
                'contact_no' => '09171358000',
                'first_name' => 'MARCOS',
                'last_name' => 'MONTENEGRO',
                'middle_name' => 'SANTO',
                'sex' => 'MALE',
                'birthday' => '1980-10-10',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'MARRIED',
                'address_line_1' => 'TALAMBAN',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_id' => 2,
                'username' => 'johndoe',
                'password' => bcrypt('secret'),
                'email' => 'johndoe@mail.com',
                'contact_no' => '09171358001',
                'first_name' => 'JOHN',
                'last_name' => 'DOE',
                'middle_name' => 'MICHAEL',
                'sex' => 'MALE',
                'birthday' => '1997-02-18',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'SINGLE',
                'address_line_1' => 'APAS',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_id' => 2,
                'username' => 'jamireyes',
                'password' => bcrypt('secret'),
                'email' => 'jamireyes1802@gmail.com',
                'contact_no' => '09171358009',
                'first_name' => 'JAMI BRENT JOHN',
                'last_name' => 'REYES',
                'middle_name' => 'EMPACES',
                'sex' => 'MALE',
                'birthday' => '1997-02-18',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'SINGLE',
                'address_line_1' => 'APAS',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 7,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_id' => 3,
                'username' => 'doctor',
                'password' => bcrypt('secret'),
                'email' => 'doctor@mail.com',
                'contact_no' => '09171358002',
                'first_name' => 'JUAN',
                'last_name' => 'DELA CRUZ',
                'middle_name' => 'SANTOS',
                'sex' => 'MALE',
                'birthday' => '1990-05-14',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'SINGLE',
                'address_line_1' => 'LAHUG',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_id' => 3,
                'username' => 'doctor1',
                'password' => bcrypt('secret'),
                'email' => 'doctor1@mail.com',
                'contact_no' => '09171358011',
                'first_name' => 'FERNANDO',
                'last_name' => 'VILLAFLORES',
                'middle_name' => 'CONCEPCION',
                'sex' => 'MALE',
                'birthday' => '1985-06-12',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'SINGLE',
                'address_line_1' => 'BANILAD',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_id' => 3,
                'username' => 'doctor2',
                'password' => bcrypt('secret'),
                'email' => 'doctor2@mail.com',
                'contact_no' => '09171358011',
                'first_name' => 'MARIA',
                'last_name' => 'JOSEFINA',
                'middle_name' => 'NAPOLES',
                'sex' => 'FEMALE',
                'birthday' => '1984-12-12',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'MARRIED',
                'address_line_1' => 'TALAMBAN',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 6,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'role_id' => 4,
                'username' => 'nurse',
                'password' => bcrypt('secret'),
                'email' => 'nurse@mail.com',
                'contact_no' => '09171358000',
                'first_name' => 'CARLY',
                'last_name' => 'MONTANO',
                'middle_name' => 'PRINCE',
                'sex' => 'FEMALE',
                'birthday' => '1990-12-12',
                'citizenship' => 'FILIPINO',
                'civil_status' => 'SINGLE',
                'address_line_1' => 'BANILAD',
                'address_line_2' => 'CEBU CITY',
                'bloodtype_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];
        User::insert($users);
    }
}
