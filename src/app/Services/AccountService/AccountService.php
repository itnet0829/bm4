<?php

declare(strict_types=1);

namespace App\Services\AccountService;

use Exception;
use Illuminate\Support\Facades\DB;

class AccountService implements IAccountService
{
    /**
     * return array
     */

    // アカウントステータスが0の時、アクティブ状態
    public function view($user_id,$name,$email,$telephone_number ) {
        $db_source = DB::table('bm_users');

        if (!empty($user_id)) {
            $db_source->where('bm_users.user_id','=',(int)$user_id);
        }

        if (!empty($name)) {
            $db_source->where('bm_users.name','LIKE',"%$name%");
        } 

        if (!empty($email)) {
            $db_source->where('bm_users.email','LIKE',"%$email%");
        } 

        if (!empty($telephone_number)) {
            $db_source->where('bm_users.telephone_number','LIKE',"%$telephone_number%");
        } 

        $db_source->where('bm_users.status','=',0)->orWhere('bm_users.status','=',1);
        
        
        $db_source->leftJoin('bm_groups','bm_users.group_id','=','bm_groups.group_id')
        ->leftJoin('role_groups','bm_users.member_limit_id','=','role_groups.id');


        $db_source->select('bm_users.user_id','bm_users.email','bm_users.name','bm_users.created_at','bm_users.telephone_number','bm_groups.group_name','role_groups.role_name',
        'bm_users.memo','bm_users.login_counter','bm_users.license_deadline','bm_users.status');

        return $db_source;
    }

    public function activates_account_view($user_id,$name,$email,$telephone_number){
        $db_source = DB::table('bm_users');
        if (!empty($user_id)) {
            $db_source->where('bm_users.user_id','=',(int)$user_id);
        }

        if (!empty($name)) {
            $db_source->where('bm_users.name','LIKE',"%$name%");
        } 

        if (!empty($email)) {
            $db_source->where('bm_users.email','LIKE',"%$email%");
        } 

        if (!empty($telephone_number)) {
            $db_source->where('bm_users.telephone_number','LIKE',"%$telephone_number%");
        } 

        $db_source->where('bm_users.status','=',2)
        ->select('bm_users.user_id','bm_users.email','bm_users.telephone_number','bm_users.name');

        return $db_source;
    }


    /**
     * @param integer $id
     * return array
     */
    public function edit($id) {
        return DB::table('bm_users')
        ->leftJoin('bet365accounts','bm_users.user_id','=','bet365accounts.user_id')
        ->select('bm_users.user_id','bm_users.email','bm_users.name','bm_users.telephone_number','bet365accounts.bet365_userid','bm_users.group_id','bm_users.member_limit_id','bm_users.memo')
        ->where('bm_users.user_id','=',$id)->first();
    }

    public function store($data,$b365data) {
        $data['status'] = 0;
        $data['encrypted_password'] = password_hash($data['encrypted_password'], PASSWORD_BCRYPT);
        $bmuid = DB::table('bm_users')
        ->insertGetId($data);

        $b365data['user_id'] = $bmuid;

        if (!empty($b365data['bet365_userid'])) {
            $b365data['bet365_enc_password'] = password_hash($b365data['bet365_enc_password'], PASSWORD_BCRYPT);
            DB::table('bet365accounts')->insert($b365data);
        }

        return 0;
    }

    public function update($id,$data) {
            DB::table('bm_users')
            ->where('bm_users.user_id','=',$id)
            ->update($data);
    }

    public function statusChange($id,$data) {
        $adm = 0;
        if ($data['status'] == 0) { $adm = 1;}  
        DB::table('bm_users')
        ->where('bm_users.user_id','=',$id)
        ->update(['status' => $adm]);

        return $adm;
    }

    public function destroy($id,$data) {
        DB::table('bm_users')
        ->where('bm_users.user_id','=',$id)
        ->update($data);
    }

    public function csv_output() {
        $db_source = DB::table('bm_users');

        $db_source->where('bm_users.status','=',0)->orWhere('bm_users.status','=',1);
        
        
        $db_source->leftJoin('bm_groups','bm_users.group_id','=','bm_groups.group_id')
        ->leftJoin('role_groups','bm_users.member_limit_id','=','role_groups.id');


        $db_source->select('bm_users.user_id','bm_users.created_at','bm_users.name','bm_users.email','bm_users.telephone_number','bm_groups.group_name','role_groups.role_name',
        'bm_users.license_deadline','bm_users.login_counter','bm_users.memo','bm_users.status');

        return $db_source;
    }

    public function group() {
        return DB::table('bm_groups')->select('group_id','group_name')->get();
    }

    public function role() {
        return DB::table('role_groups')->select('id','role_name')->get();
    }
}
