<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MAX = 9;
        $role_name = ['itim_applicant','itim_passing','pending','wipper','sponsor','pr','secretary','vice-president','president','admin'];
        for($i = 0 ; $i < $MAX ; $i++){
            DB::table('roles')->insert([
                'role_name' => $role_name[$i],
            ]);
        }
    }
}
