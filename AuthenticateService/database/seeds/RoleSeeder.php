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
        $MAX = 2;
        $role_name = ['itim','wippper'];
        for($i = 0 ; $i < $MAX ; $i++){
            DB::table('roles')->insert([
                'role_name' => $role_name[$i],
            ]);
        }
    }
}
