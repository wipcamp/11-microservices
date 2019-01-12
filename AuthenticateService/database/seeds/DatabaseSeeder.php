<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AuthenticationSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            Role_PermissionSeeder::class
        ]);
    }
}
