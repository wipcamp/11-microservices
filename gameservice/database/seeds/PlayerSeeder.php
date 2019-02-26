<?php

use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('player_game_1')->insert
        ([
        'wip_id'=>110000,
        'facebook_id'=>00001011,
        'player_name' =>'zompong',
        'lv'=>100,
        'exp'=>999,
        'hp'=>1111,
        'max_hp'=>999
                   ]);
    }
}