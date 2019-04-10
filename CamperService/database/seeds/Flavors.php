<?php

use Illuminate\Database\Seeder;

class Flavors extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MAX = 10;
        $flavor_names = ['ซาบะ(ดำ)','แซลม่อ(ส้ม)','ไดฟูกุ(แดง)','โมจิ(ฟ้า)','วาซาบิ(เขียว)','โชยุ(น้ำตาล)','พุดดิ้ง(เหลือง)','มันม่วง(ม่วง)','ซากุระ(ชมพู)','มัจฉะ(เขียวแก่)'];
        for($i = 0 ; $i != $MAX ; $i++){
            DB::table('flavors')->insert([
                'name' => $flavor_names[$i],
            ]);
        }
    }
}
