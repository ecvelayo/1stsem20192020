<?php

use Illuminate\Database\Seeder;

class DeliveryFeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('delivery__fees')->insert([
            [

            'price' => 50.00

            ]
        ]);
    }
}
