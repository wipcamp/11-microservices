<?php

use Illuminate\Database\Seeder;

class janpuseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('janpu')->insert
        ([
        'player_name' =>'wippo',
        'score'=>1011
                   ]);
                   DB::table('janpu')->insert
        ([
        'player_name' =>'wippo',
        'score'=>1011
                   ]);
                   DB::table('janpu')->insert
        ([
        'player_name' =>'wippo',
        'score'=>1011
                   ]);
    }
}
