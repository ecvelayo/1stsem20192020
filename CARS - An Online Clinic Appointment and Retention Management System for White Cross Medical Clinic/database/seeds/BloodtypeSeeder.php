<?php

use Illuminate\Database\Seeder;
use App\bloodtype;

class BloodtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['description' => 'A-'],
            ['description' => 'A+'],
            ['description' => 'AB-'],
            ['description' => 'AB+'],
            ['description' => 'O'],
            ['description' => 'B-'],
            ['description' => 'B+'],
        ];

        DB::table('bloodtypes')->insert($data);
    }
}
