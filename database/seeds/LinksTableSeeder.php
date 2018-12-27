<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                    'link_name'=>'后盾网',
                    'link_intro'=>'人人做后盾',
                    'link_url'=>'www.baidu.com',
                    'link_order'=>'1',
            ],
            [
                    'link_name'=>'传智播客',
                    'link_intro'=>'传播智慧,桃李天下',
                    'link_url'=>'www.baidu.com',
                    'link_order'=>'2',
            ]
        ];

        DB::table('links')->insert($data);

    }
}
