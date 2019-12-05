<?php

use Illuminate\Database\Seeder;

class ServicesInterventionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

    	DB::table('interventions')->insert([
            'interven_name' =>  'Individual Counseling',
            'descrp' => 'Individual Conseling',
            'department_id'=> 2
                
         ]);


    	DB::table('interventions')->insert([
            'interven_name' =>  'Drug Test',
            'descrp' => 'Drug Test',
            'department_id'=> 2
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Group Therapy',
            'descrp' => 'Group Therapy',
            'department_id'=> 2
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Family Counseling',
            'descrp' => 'Family Counseling',
            'department_id'=> 2
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Phone Follow Up',
            'descrp' => 'Phone Follow Up',
            'department_id'=> 2
                
         ]);
    	
    	DB::table('interventions')->insert([
            'interven_name' =>  'Spiritual Activity',
            'descrp' => 'Spiritual Activity',
            'department_id'=> 2
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Home Visit',
            'descrp' => 'Home Visit',
            'department_id'=> 2
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'MIOP Sessions',
            'descrp' => 'MIOP Sessions',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Individual Sessions',
            'descrp' => 'Individual Sessions',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Marital Sessions',
            'descrp' => 'Marital Sessions',
            'department_id'=> 3
                
         ]);
    	DB::table('interventions')->insert([
            'interven_name' =>  'Family Dialogues',
            'descrp' => 'Family Dialogues',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Psych Evaluation',
            'descrp' => 'Psych Evaluation',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Alternative Activities',
            'descrp' => 'Alternative Activities',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Home Visit',
            'descrp' => 'Home Visit',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Drug Testing',
            'descrp' => 'Drug Testing',
            'department_id'=> 3
                
         ]);

    	DB::table('interventions')->insert([
            'interven_name' =>  'Referral',
            'descrp' => 'Referral',
            'department_id'=> 3
                
         ]);

    	
    }
}
