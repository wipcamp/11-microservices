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
        $MAX = 5;
        $role_name = ['itim','wippper','admin','pr','sponsor'];
        for($i = 0 ; $i < $MAX ; $i++){
            DB::table('roles')->insert([
                'role_name' => $role_name[$i],
            ]);
        }
    }
}
