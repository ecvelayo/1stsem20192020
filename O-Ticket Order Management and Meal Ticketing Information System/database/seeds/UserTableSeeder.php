<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use  Illuminate\Support\Facades\DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'firstname' => Super,
            'middlename' => Null,
            'lastname' => Admin,
            'birthdate' => now(),
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'date_registered' => now(),
            'status' => '1',
            'user_type' => '0'
        ]);

        // DB::table('employee')->insert([
        //     'employee_id' => '1',
        //     'emp_type' => '0',
        //     'date_hired' => now(),
        // ]);

    }
}
