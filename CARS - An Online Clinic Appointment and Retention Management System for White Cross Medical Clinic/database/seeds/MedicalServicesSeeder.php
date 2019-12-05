<?php

use Illuminate\Database\Seeder;
use App\medical_service;

class MedicalServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        medical_service::insert([
            ['description' => 'MEDICAL CHECK-UP', 'rate' => '250.00'],
            ['description' => 'DRUG TESTING', 'rate' => '300.00'],
            ['description' => 'CHEST X-RAY', 'rate' => '230.00'],
            ['description' => 'BLOOD TYPING', 'rate' => '150.00'],
            ['description' => 'PREGNANCY TEST', 'rate' => '100.00'],
            ['description' => 'BLOOD SUGAR TEST', 'rate' => '80.00'],
            ['description' => 'HEPATITIS A TEST', 'rate' => '500.00'],
            ['description' => 'HEPATITIS B TEST', 'rate' => '250.00'],
            ['description' => 'CBC', 'rate' => '120.00'],
            ['description' => 'URINALYSIS', 'rate' => '80.00'],
            ['description' => 'STOOL EXAM', 'rate' => '80.00']
        ]);
    }
}
