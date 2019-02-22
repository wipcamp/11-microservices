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
        $this->call(PlayerSeeder::class);
        $this->call(Climbingseeder::class);
        $this->call(janpuseeder::class);
    }
}
