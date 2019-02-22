<?php

use Illuminate\Database\Seeder;

class Climbingseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('Climbing')->insert
        ([
        'player_name' =>'wippo',
        'score'=>1011
                   ]);
                   DB::table('Climbing')->insert
        ([
        'player_name' =>'wippo',
        'score'=>1011
                   ]);
                   DB::table('Climbing')->insert
        ([
        'player_name' =>'wippo',
        'score'=>1011
                   ]);
    }
}
