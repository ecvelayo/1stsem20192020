<?php

use Illuminate\Database\Seeder;
use App\doctor_schedule;
use Carbon\Carbon;

class DocScheduleSeeder extends Seeder
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
                'doctor_id' => 4,
                'day' => "MON,WED,FRI",
                'start_time' => '9:00',
                'end_time' => '12:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'doctor_id' => 4,
                'day' => 'TUE,THU',
                'start_time' => '13:00',
                'end_time' => '17:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];
        doctor_schedule::insert($data);
    }
}
