<?php

use Illuminate\Database\Seeder;
use App\Users;
use App\Departments;
use App\User_roles;
use App\Checklist;
use App\Gender;
use App\Drugs_Abused;
use App\Civil_Status;
use App\Educational_Attainment;
use App\Employment_Status;
use App\services;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert(
        [
            'parent' => '0',
            'name' =>'Superadmin',
            'description' => 'Superadmin',
        ]);
         DB::table('user_roles')->insert([

            'parent' => '0',
            'name' =>'Admin',
            'description' => 'Admin',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Doctor',
            'description' => 'Doctor',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Nurse',
            'description' => 'Nurse',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Social Worker',
            'description' => 'Social Worker',
        ]);


        $doctor = User_roles::where('name','Doctor')->first();
        $id_doctor = $doctor->id;

         DB::table('user_roles')->insert([
            'parent' => $id_doctor,
            'name' =>'Physciatrist',
            'description' => 'Physciatrist',
        ]);


         DB::table('user_roles')->insert([
            'parent' => $id_doctor,
            'name' =>'Dentist',
            'description' => 'Dentist',
        ]);

         DB::table('departments')->insert([
                'id' => 1,
                'department_name' => 'In-patient',
                'description' => 'In-patient'
         ]);

        DB::table('departments')->insert([
                'id' => 2,
                'department_name' => 'Out-patient',
                'description' => 'Out-patient'
         ]);

        DB::table('departments')->insert([
                'id' => 3,
                'department_name' => 'Aftercare',
                'description' => 'Aftercare'
         ]);



         DB::table('case__types')->insert([
                'case_name' => 'Voluntary Submission',
                'court_order' => 0

         ]);

         DB::table('case__types')->insert([
                'case_name' => 'Voluntary with Court Order',
                'court_order' => 1
                
         ]);

         DB::table('case__types')->insert([
                'case_name' => 'Plea Bargain',
                'court_order' => 0
                
         ]);

         DB::table('case__types')->insert([
                'case_name' => 'Plea Bargain with Court Order',
                'court_order' => 1
                
         ]);

         DB::table('dismissal__reasons')->insert([
                'reason' => 'RELEASED AGAINST REHABILITATION ADVICE/ESCAPED',
                
         ]);

         DB::table('dismissal__reasons')->insert([
                'reason' => 'OUT ON PASS/TURNOVER TO OTHER AGENCY',
            
         ]);

         DB::table('dismissal__reasons')->insert([
                'reason' => ' MEDICAL/PSYCHIATRIC/EARLY RELEASE',
                
         ]);

         DB::table('dismissal__reasons')->insert([
                'reason' => 'DEATH (ACCIDENT, ILLNESS, SUICIDE, ETC.)',
                
         ]);


        $list = new Checklist([
            'parent' => 0,
            'name' =>  'Requirements Upon Admission',
            'has_sublist' => 0
        ]);

        $list->save();

        $list_one = Checklist::where('name','Requirements Upon Admission')->get();

        foreach($list_one as $one_id)
        {
            $ido = $one_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $ido,
            'name' =>  'Endorsement/Referral Form',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $ido,
            'name' =>  'Court Order',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $ido,
            'name' =>  'Petition for Confinement',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $ido,
            'name' =>  'Drug Dependency Certificate',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $ido,
            'name' =>  'Medical Requirements',
            'has_sublist' => 1
                
         ]);

        $list_two = Checklist::where('name','Medical Requirements')->get();

        foreach($list_two as $two_id)
        {
            $idt = $two_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Chest X-ray Result (within 6 months)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'ECG Result (35 yrs and above, within 6 mo.)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Urinalysis (within 1 month)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'HbsAg (within 1 month)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Complete Blood Count ( within 1 month)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Serum Crea (within 1 month)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'SGPT (within 1 month)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Transvaiginal Sonography (TVS)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Drug Test (Upom Admission)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Pregnancy Test (w/in 1 week/Upon Admission)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Medical Cetificate (Fit for Rehab)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idt,
            'name' =>  'Psychological Certificate (Fit for Rehab)',
            'has_sublist' => 0
                
         ]);

        $listz = new Checklist([
            'parent' => 0,
            'name' =>  'Procedure by TRC Staff In-Charge',
            'has_sublist' => 0
        ]);

        $listz->save();

        $listz_one = Checklist::where('name','Procedure by TRC Staff In-Charge')->get();

        foreach($listz_one as $onez_id)
        {
            $idz = $onez_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Memorandum of Undertakings',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Intake Interview',
            'has_sublist' => 1
                
         ]);

        $list_twoz = Checklist::where('name','Intake Interview')->get();

        foreach($list_twoz as $twoz_id)
        {
            $idtz = $twoz_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $idtz,
            'name' =>  'Psychologist',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idtz,
            'name' =>  'Social Worker',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idtz,
            'name' =>  'Nurse',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Medical',
            'has_sublist' => 1
                
         ]);

        $list_trez = Checklist::where('name','Medical')->get();

        foreach($list_trez as $trez_id)
        {
            $idtrz = $trez_id->id;
        }


        DB::table('checklists')->insert([
            'parent' => $idtrz,
            'name' =>  'Physical Examination (Admission)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idtrz,
            'name' =>  'Physical Examination (Discharge)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Psychological Report',
            'has_sublist' => 1
                
         ]);

        $list_quatz = Checklist::where('name','Psychological Report')->get();

        foreach($list_quatz as $quatz_id)
        {
            $idqtz = $quatz_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $idqtz,
            'name' =>  'Psychological Test',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idqtz,
            'name' =>  'Pre-Evaluation Report',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idqtz,
            'name' =>  'Post-Evaluation Report',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  "Social Worker's Report",
            'has_sublist' => 1
                
         ]);

        $list_sank = Checklist::where('name',"Social Worker's Report")->get();

        foreach($list_sank as $sank_id)
        {
            $idsk = $sank_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $idsk,
            'name' =>  'Social Case Study',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idsk,
            'name' =>  'Progress Notes',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Periodic Report to Court',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Treatment Plan',
            'has_sublist' => 1
                
         ]);

        $list_sis = Checklist::where('name','Treatment Plan')->get();

        foreach($list_sis as $sis_id)
        {
            $idss = $sis_id->id;
        }

        DB::table('checklists')->insert([
            'parent' => $idss,
            'name' =>  'Social Worker',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idss,
            'name' =>  'Psychologist',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idss,
            'name' =>  'Medical',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Discharge Summary / Medical Instructions',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Final Evaluation (Psychologist)',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Final Progress Report',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Certificate of Completion/Panunumpa',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Clearance',
            'has_sublist' => 0
                
         ]);

        DB::table('checklists')->insert([
            'parent' => $idz,
            'name' =>  'Temporary Release Order',
            'has_sublist' => 0
                
         ]);

        DB::table('civil__statuses')->insert([
            'name' =>  'Single',
                
         ]);

        DB::table('civil__statuses')->insert([
            'name' =>  'Married',
                
         ]);

        DB::table('civil__statuses')->insert([
            'name' =>  'Widowed',
        ]);
        DB::table('interventions')->insert([
            'interven_name' =>  'Individual Counseling',
            'descrp' => 'Individual Conseling',
            'department_id'=> 3
                
         ]);


        DB::table('interventions')->insert([
            'interven_name' =>  'Drug Test',
            'descrp' => 'Drug Test',
            'department_id'=> 3
                
         ]);

        DB::table('civil__statuses')->insert([
            'name' =>  'Separated',
                
         ]);

        DB::table('civil__statuses')->insert([
            'name' =>  'Divorced',
                
         ]);

        DB::table('genders')->insert([
            'name' =>  'Male',
                
         ]);

        DB::table('genders')->insert([
            'name' =>  'Female',
                
         ]);

        DB::table('drugs__abuseds')->insert([
            'name' =>  'Severe Drug Dependence',
                
         ]);

        DB::table('drugs__abuseds')->insert([
            'name' =>  'Moderate Drug Dependence',
                
         ]);

        DB::table('drugs__abuseds')->insert([
            'name' =>  'Not a Drug Dependent',
        ]);

        DB::table('city__jails')->insert([
            'jail_id' =>  rand(),
            'name' => 'Mandaue City Jail'
        ]);


        DB::table('interventions')->insert([
            'interven_name' =>  'Group Therapy',
            'descrp' => 'Group Therapy',
            'department_id'=> 3
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Family Counseling',
            'descrp' => 'Family Counseling',
            'department_id'=> 3
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Phone Follow Up',
            'descrp' => 'Phone Follow Up',
            'department_id'=> 3
                
         ]);
        
        DB::table('interventions')->insert([
            'interven_name' =>  'Spiritual Activity',
            'descrp' => 'Spiritual Activity',
            'department_id'=> 3
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Home Visit',
            'descrp' => 'Home Visit',
            'department_id'=> 3
                
         ]);

        DB::table('educational__attainments')->insert([
            'name' =>  'Grade-school Graduate',
                
         ]);

        DB::table('educational__attainments')->insert([
            'name' =>  'High-school Graduate',
                
         ]);

        DB::table('educational__attainments')->insert([
            'name' =>  'College Graduate',
                
         ]);

        DB::table('employment__statuses')->insert([
            'name' =>  'Employed',
                
         ]);

        DB::table('employment__statuses')->insert([
            'name' =>  'Unemployed',
                
         ]);


        DB::table('interventions')->insert([
            'interven_name' =>  'MIOP Sessions',
            'descrp' => 'MIOP Sessions',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Individual Sessions',
            'descrp' => 'Individual Sessions',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Marital Sessions',
            'descrp' => 'Marital Sessions',
            'department_id'=> 2
                
         ]);
        DB::table('interventions')->insert([
            'interven_name' =>  'Family Dialogues',
            'descrp' => 'Family Dialogues',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Psych Evaluation',
            'descrp' => 'Psych Evaluation',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Alternative Activities',
            'descrp' => 'Alternative Activities',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Home Visit',
            'descrp' => 'Home Visit',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Drug Testing',
            'descrp' => 'Drug Testing',
            'department_id'=> 2
                
         ]);

        DB::table('interventions')->insert([
            'interven_name' =>  'Referral',
            'descrp' => 'Referral',
            'department_id'=> 2
                
         ]);


        DB::table('services')->insert([
            'name' => 'MEDICAL (INSIDE FACILITY)',
            'description' => 'MEDICAL (INSIDE FACILITY)'

        ]);

        DB::table('services')->insert([
            'name' => 'MEDICAL (OUTSOURCE)',
            'description' => 'MEDICAL (OUTSOURCE)'

        ]);

        DB::table('services')->insert([
            'name' => 'DENTAL',
            'description' => 'DENTAL'

        ]);

        DB::table('services')->insert([
            'name' => 'PSYCHIATRIC',
            'description' => 'PSYCHIATRIC'

        ]);

         DB::table('services')->insert([
            'name' => 'LOCAL HEALTH FACILITY',
            'description' => 'LOCAL HEALTH FACILITY'

        ]);

        DB::table('services')->insert([
            'name' => 'LIVELIHOOD SERVICE',
            'description' => 'LIVELIHOOD SERVICE'

        ]);

         DB::table('services')->insert([
            'name' => 'SOCIAL SERVICE',
            'description' => 'SOCIAL SERVICE'

        ]);



        DB::table('services')->insert([
            'name' => 'LEGAL SERVICE',
            'description' => 'LEGAL SERVICE'

        ]);


        $socialservice = Services::where('name','SOCIAL SERVICE')->first();
        $ss = $socialservice->id;


        DB::table('services')->insert([
            'parent' => $ss,
            'name' => 'CASE STUDY WORK',
            'description' => 'CASE STUDY WORK'

        ]);

        DB::table('services')->insert([
            'parent' => $ss,
            'name' => 'HOME VISITATION',
            'description' => 'HOME VISITATION'

        ]);

         DB::table('services')->insert([
            'parent' => $ss,
            'name' => 'FAMILY PSYCHOTHERAPY',
            'description' => 'FAMILY PSYCHOTHERAPY'

        ]);

        DB::table('services')->insert([
            'parent' => $ss,
            'name' => 'COURT APPEARANCE',
            'description' => 'COURT APPEARANCE'

        ]);


        $Mif = Services::where('name','MEDICAL (INSIDE FACILITY)')->first();
        $inside = $Mif->id;

        $Mot = Services::where('name','MEDICAL (OUTSOURCE)')->first();
        $out = $Mot->id;

        $Dental = Services::where('name','DENTAL')->first();
        $dent = $Dental->id;

        $psychiatric = Services::where('name','PSYCHIATRIC')->first();
        $pt = $psychiatric->id;

        $localHealth = Services::where('name','LOCAL HEALTH FACILITY')->first();
        $local = $localHealth->id;

        $liveli = Services::where('name','LIVELIHOOD SERVICE')->first();
        $hood = $liveli->id;

        $legal = Services::where('name','LEGAL SERVICE')->first();
        $legalServices = $legal->id;


        $doctor = User_roles::where('name', 'Doctor')->first();
            $doc =  $doctor->id;
        $Nurse = User_roles::where('name', 'Nurse')->first();
            $nur =  $Nurse->id;

        $Soci = User_roles::where('name', 'Social Worker')->first();
            $social = $Soci->id;

        $Psyc = User_roles::where('name', 'Physciatrist')->first();
            $psychiat = $Psyc->id;
        $Dentist = User_roles::where('name', 'Dentist')->first();
            $den = $Dentist->id;

          DB::table('display')->insert([
            'service_id' => $inside,
            'role' => $doc

        ]);

         DB::table('display')->insert([
            'service_id' => $out,
            'role' => $doc

        ]);


         DB::table('display')->insert([
            'service_id' => $dent,
            'role' => $den

        ]);

        DB::table('display')->insert([
            'service_id' =>  $ss,
            'role' => $psychiat

        ]);


         DB::table('display')->insert([
            'service_id' => $local,
            'role' => $nur

        ]);

        DB::table('display')->insert([
            'service_id' => $hood,
            'role' => $nur

        ]);

        DB::table('display')->insert([
            'service_id' => $hood,
            'role' => $social

        ]);

        DB::table('display')->insert([
            'service_id' => $legalServices,
            'role' => $social

        ]);



        
        $user = new Users([
            'user_id' => rand(),
            'fname' => 'Erol',
            'lname' => 'Branzuela',
            'username' => 'Superadmin',
            'password' => Hash::make('erol'),
            'contact' => '09561137482',
            'email' => 'erolbranzuela@ymail.com',
            'role' => '1',
        ]);

        $user->save();
    }
}
