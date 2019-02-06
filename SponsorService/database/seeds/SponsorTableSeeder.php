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
            'sponsor_name' => 'bangmod',
            'sponsor_order' => 1,
            'sponsor_path' => 'https://storage.freezer.in.th/sponsor/bangmode.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=VizhBfmrCSvpJqGRKvEC%2F20190206%2F%2Fs3%2Faws4_request&X-Amz-Date=20190206T110932Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=999113df84783dbd9330725139db2de87508a438f6f9c7d27ac76325168f80cd',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 2,
            'sponsor_name' => 'yipinsoi',
            'sponsor_order' => 2,
            'sponsor_path' => 'https://storage.freezer.in.th/sponsor/yipinsoi.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=VizhBfmrCSvpJqGRKvEC%2F20190206%2F%2Fs3%2Faws4_request&X-Amz-Date=20190206T111008Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=6edcd8e65e470972c516c347d7df6a440b3099b96ace8fe371fd87f4ceddfc91',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 3,
            'sponsor_name' => 'gable',
            'sponsor_order' => 3,
            'sponsor_path' => 'https://storage.freezer.in.th/sponsor/gable.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=VizhBfmrCSvpJqGRKvEC%2F20190206%2F%2Fs3%2Faws4_request&X-Amz-Date=20190206T111020Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=b19863c0163c1cf92597c17a53a4632afc52ae7fade58547ac57c0cd853a523f',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 4,
            'sponsor_name' => 'bowbakery',
            'sponsor_order' => 3,
            'sponsor_path' => 'https://storage.freezer.in.th/sponsor/bowbakery.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=VizhBfmrCSvpJqGRKvEC%2F20190206%2F%2Fs3%2Faws4_request&X-Amz-Date=20190206T111046Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9de8ef7f0e237d94bda7c7f5b70e07d97ae9dbd02e50ca4b1ca7db599e40c02c',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 5,
            'sponsor_name' => 'camphub',
            'sponsor_order' => 2,
            'sponsor_path' => 'https://storage.freezer.in.th/sponsor/camphub.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=VizhBfmrCSvpJqGRKvEC%2F20190206%2F%2Fs3%2Faws4_request&X-Amz-Date=20190206T111102Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=1fd34afe8c56c9eca5dce121b7e572863207d4d0b374b89e59d0ec414005c642',
        ]);
        DB::table('sponsor')->insert([
            'sponsor_id' => 6,
            'sponsor_name' => 'dcs',
            'sponsor_order' => 3,
            'sponsor_path' => 'https://storage.freezer.in.th/sponsor/dcs.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=VizhBfmrCSvpJqGRKvEC%2F20190206%2F%2Fs3%2Faws4_request&X-Amz-Date=20190206T111217Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=cfa4d9e91a2c479689d5d46cb719b2fdb2a5108300c47e5ea82383b92ffe0cfb',
        ]);

    }
}
