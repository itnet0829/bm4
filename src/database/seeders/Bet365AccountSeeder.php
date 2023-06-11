<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Seeder;

class Bet365AccountSeeder extends Seeder
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
                'user_id' => 6,
                'bet365_userid' => 'yangio',
                'bet365_enc_password' => password_hash('kyanai100', PASSWORD_DEFAULT),
            ),
            array(
                'user_id' => 7,
                'bet365_userid' => 'yangio21',
                'bet365_enc_password' => password_hash('kyanai100s', PASSWORD_DEFAULT),
            ),
            array(
                'user_id' => 8,
                'bet365_userid' => 'yangio232',
                'bet365_enc_password' => password_hash('kyanai100sde', PASSWORD_DEFAULT),
            ),
            array(
                'user_id' => 9,
                'bet365_userid' => 'yangiodqoj',
                'bet365_enc_password' => password_hash('kyanai100rfr', PASSWORD_DEFAULT),
            ),
            array(
                'user_id' => 10,
                'bet365_userid' => '12312dkq',
                'bet365_enc_password' => password_hash('kyanai1dej00', PASSWORD_DEFAULT),
            ),
        );        
        $this->DB->table('bet365accounts')->insert($data);
    }
}
