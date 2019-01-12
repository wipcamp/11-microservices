<?php

use Illuminate\Database\Seeder;

class Role_PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $MAX_role = 5;
        $role_id = [1,2,3,4,5];
        $permission_id = [1,2,3,4,5,6,7,8];
        for($i = 0 ; $i < $MAX_role ; $i++){
            DB::table('role_permissions')
            ->join('role_permissions','role_permissions.roles_id','=','roles.roles_id')
            ->join('role_permissions','role_permissions.permission_id','=','permissions.permission_id')
            ->insert([
                'role_id' => $role_id[$i],
                'permission_id' => $permission_id[$i]
            ]);
        }
    }
}
