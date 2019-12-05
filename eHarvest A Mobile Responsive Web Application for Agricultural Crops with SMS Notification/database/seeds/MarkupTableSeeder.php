<?php

use Illuminate\Database\Seeder;

class MarkupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('markups')->insert([
            [

            'percentage' => 1.15

            ]
        ]);
    }
}
