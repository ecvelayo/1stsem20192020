<?php

use Illuminate\Database\Seeder;
use App\services_availed;
use App\services_availed_lines;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'patient_id' => 2,
                'staff_id' => 7,
                'amount_paid' => '1000',
                'total_amount' => '550'
            ],
            [
                'patient_id' => 2,
                'staff_id' => 7,
                'amount_paid' => '1000',
                'total_amount' => '500'
            ]
        ];

        services_availed::insert($data);

        $data =[
            [
                'services_availed_id' => 1,
                'medical_service_id' => 1,
                'appointment_id' => 1
            ]
        ];

        services_availed_lines::insert($data);

        $data =[
            [
                'services_availed_id' => 1,
                'medical_service_id' => 2
            ],
            [
                'services_availed_id' => 2,
                'medical_service_id' => 7,
            ]
        ];

        services_availed_lines::insert($data);
    }
}
