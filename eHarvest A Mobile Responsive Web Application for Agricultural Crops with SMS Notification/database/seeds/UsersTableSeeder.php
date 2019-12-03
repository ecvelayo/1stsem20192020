<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker; 

class UsersTableSeeder extends Seeder
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
            [
            'password' => bcrypt('admin12345'),
            'firstname' => 'Admin',
            'lastname' => 'User',
            'contact' => '639055626875',
            'address' => 'USC Talamban',
            'birthdate' => '1993-10-22',
            'type' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at'=> now(),
            'photo' =>'https://storage.googleapis.com/eharvest-files/user/photos/images.png',  
            ],[

                'password' => bcrypt('admin12345'),
                'firstname' => 'Justin',
                'lastname' => 'Manigo',
                'contact' => '639983128845',
                'address' => 'Naga City Cebu',
                'birthdate' => '1998-01-30',
                'type' => 'Farmer',
                'email' => 'justinmanigo.farmer@gmail.com',
                'email_verified_at'=> now(),
                'photo' => 'https://storage.googleapis.com/eharvest-files/user/photos/images.png',
                ],[

                'password' => bcrypt('admin12345'),
                'firstname' => 'JeChrist',
                'lastname' => 'Vildosola',
                'contact' => '639953216843',
                'address' => 'Cebu City',
                'birthdate' => '1993-01-12',
                'type' => 'Driver',
                'email' => 'jechristvildosola.eharvest@gmail.com',
                'email_verified_at'=> now(),
                'photo' => 'https://storage.googleapis.com/eharvest-files/user/photos/images.png',
                ],[

                'password' => bcrypt('admin12345'),
                'firstname' => 'Mang',
                'lastname' => 'Inasal',
                'contact' => '639983128845',
                'address' => 'Lilo-an Cebu',
                'birthdate' => '1993-01-12',
                'type' => 'Farmer',
                'email' => 'manginasal@gmail.com',
                'email_verified_at'=> now(),
                'photo' => 'https://storage.googleapis.com/eharvest-files/user/photos/images.png',
                ],[

            'password' => bcrypt('admin12345'),
            'firstname' => 'Mark ',
            'lastname' => 'Salazar',
            'contact' => '639055626875',
            'address' => 'Mandaue Wireless',
            'birthdate' => '1991-08-15',
            'type' => 'Admin',
            'email' => 'marksalazar.eharvest@gmail.com',
            'email_verified_at'=> now(),
            'photo' => 'https://storage.googleapis.com/eharvest-files/user/photos/images.png',
            ]
        ]);
    }
}
