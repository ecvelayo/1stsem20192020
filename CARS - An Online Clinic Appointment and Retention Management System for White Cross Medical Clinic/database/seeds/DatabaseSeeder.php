<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(BloodtypeSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(DocScheduleSeeder::class);
        // $this->call(BillSeeder::class);
        $this->call(VitalSignSeeder::class);
        $this->call(MedicalServicesSeeder::class);
    }
}
