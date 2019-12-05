<?php

use Illuminate\Database\Seeder;
use App\appointment;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
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
                'appointment_date' => Carbon::now()->format('Y-m-d'),
                'doctor_schedule_id' => 1,
                'staff_id' => 2,
                'patient_id' => 3,
                'status' => 'PENDING',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        appointment::insert($data);
    }
}
