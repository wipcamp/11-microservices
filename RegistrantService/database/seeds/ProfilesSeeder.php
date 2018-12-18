<?php

use Illuminate\Database\Seeder;

class ProfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=0; $i < 2; $i++) { 
            DB::table('profiles')->insert([
                'prefix_name' => 'นาย',
                'fistname_th' =>'ทินภัทร',
                'lastname_th' => 'มงคลธนโชค',
                'fistname_en' => null,
                'lastname_en' => null,
                'telno' => null,
                'nickname' => 'fame',
                'gender' => 'male',
                'school_id' => null,
                'school_name' => null,
                'school_level' => null,
                'school_major'=> null,
                'gpax' => null,
                'religion' => null,
                'allergic_food' => null,
                'allergic_drug' => null,
                'cangenital_disease' => null,
                'email' => null,
                'dob' => null,
                'citizen_no' => 1041672158743,
                'guardian_relative' => null,
                'guardian_telno' => null,
                'medical_approved' => null,
                ]);
            }
    }
}
