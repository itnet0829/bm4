<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder;

class BMGroupSeeder extends Seeder
{

    private $DB;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->DB = $databaseManager;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('group_name'=>'銀行振込'),
            array('group_name'=>'クレカ払い'),
            array('group_name'=>'テレグラム'),
            array('group_name'=>'薬中毒'),
            array('group_name'=>'REAL-T'),
            array('group_name'=>'現実世界クラブ'),
            array('group_name'=>'著作権はしていいよ。')
        );

        $this->DB->table('bm_groups')->insert($data);
    }
}
