<?php

namespace Database\Seeders;
use Illuminate\Database\DatabaseManager;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleGroupSeeder extends Seeder
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
            array('role_name'=>'A項目'),
            array('role_name'=>'B項目'),
            array('role_name'=>'C項目'),
            array('role_name'=>'D項目'),
            array('role_name'=>'E項目'),
        );

        $this->DB->table('role_groups')->insert($data);
    }
}
