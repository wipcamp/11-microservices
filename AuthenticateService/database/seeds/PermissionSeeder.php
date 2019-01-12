<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MAX = 8;
        $permission_name = ['view_Dashboard','view_Registrants','view_QuestionAndAnswer','view_sponsor','edit_sponsor',
                            'view_Approve','post_Announce','select_itim_passing','admin_approve'];
        for($i = 0 ; $i < $MAX ; $i++){
            DB::table('permissions')->insert([
                'permission_name' => $permission_name[$i],
            ]);
        }
    }
}
