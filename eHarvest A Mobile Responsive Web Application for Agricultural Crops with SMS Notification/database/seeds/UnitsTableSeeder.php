<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Db::table('units')->insert([
            [
        
            'name' => 'Piece',
           
            ], [
        
                'name' => '1/4 Kilogram',
               
                ], [
        
                    'name' => '1/2 Kilogram',
                   
                    ], [
        
                        'name' => 'Dozen',
                       
                        ],[

            'name' => 'Kilogram',

            ],[

            'name' => 'Pound',

            ],[

            'name' => 'Sack',
            
            ]
        ]);
    }
}

