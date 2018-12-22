<?php

use Illuminate\Database\Seeder;

class SponsorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sponsor')->insert([
            'sponsor_id' => 1,
            'sponsor_name' => 'Testone',
            'sponsor_order' => 1,
            'sponsor_path' => 'Testone',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 2,
            'sponsor_name' => 'Testtwo',
            'sponsor_order' => 2,
            'sponsor_path' => 'Testtwo',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 3,
            'sponsor_name' => 'Testtree',
            'sponsor_order' => 3,
            'sponsor_path' => 'Testtree',
        ]);
    }
}
