<?php

use Illuminate\Database\Seeder;

class AuthenticationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MAX_RANDOM = 2;
        $provider_id = ["112452273135656", "89101113"];
        $provider_name = ['facebook', 'facebook'];
        $role = ['itim_applicant','itim_passing'];
        $wip_id = null;
        for($i = 0 ; $i < $MAX_RANDOM ; $i++){
            DB::table('credential')->insert([
                'provider_id' => $provider_id[$i],
                'provider_name' => $provider_name[$i],
                'role' => $role[$i],
                'wip_id' => $wip_id
            ]);
        }
    }
}
