<?php

use Illuminate\Database\Seeder;
use App\role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['description' => 'ADMIN'],
            ['description' => 'PATIENT'],
            ['description' => 'DOCTOR'],
            ['description' => 'NURSE']
        ];
        role::insert($roles);
    }
}
