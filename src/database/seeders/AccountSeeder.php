<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{

    private $DB;

    public function __construct(DatabaseManager $databaseManager)
    {
        $this->DB = $databaseManager;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'email' => 'test1@test.com',
                'telephone_number' => '09012341234',
                'encrypted_password' => password_hash('kozastartup', PASSWORD_DEFAULT),
                'name' => 'John Doe',
                'status' => 2
            ), 
            array(
                'email' => 'test2@test.com',
                'telephone_number' => '09022342239',
                'encrypted_password' => password_hash('kyanai100', PASSWORD_DEFAULT),
                'name' => 'Sarah Smith',
                'status' => 2
            ),
            array(
                'email' => 'arisa@example.com',
                'telephone_number' => '090223449201',
                'encrypted_password' => password_hash('ariarinco', PASSWORD_DEFAULT),
                'name' => '佐藤 有紗',
                'status' => 2
            ),
            array(
                'email' => 'rukawa@example.com',
                'telephone_number' => '090233913',
                'encrypted_password' => password_hash('rukawayus', PASSWORD_DEFAULT),
                'name' => '流川 雄一',
                'status' => 2
            ),
            array(
                'email' => 'asato@okiu.ac.jp',
                'telephone_number' => '09021230124',
                'encrypted_password' => password_hash('asatohajimenn', PASSWORD_DEFAULT),
                'name' => '安里肇',
                'status' => 2
            )
        );        
        $this->DB->table('bm_users')->insert($data);
    }
}
