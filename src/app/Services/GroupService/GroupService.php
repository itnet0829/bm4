<?php

declare(strict_types=1);

namespace App\Services\GroupService;

use Exception;
use Illuminate\Support\Facades\DB;

class GroupService implements IGroupService
{
    /**
     * return array
     */

    // アカウントステータスが0の時、アクティブ状態
    public function view($group_id,$group_name,$administrator_name) {

        $db_source = DB::table('bm_groups');

        if (!empty($group_id)) {
            $db_source->where('bm_groups.group_id','=',$group_id);
        }

        if (!empty($group_name)) {
            $db_source->where('bm_groups.group_name','LIKE',"%$group_name%");
        }

        if (!empty($administrator_name)) {
            $db_source->where('bm_groups.administrator_name','LIKE',"%$administrator_name%");
        }

        return $db_source;
    }

    public function store($data) {
        return DB::table('bm_groups')->insert($data);
    }

    public function edit($id) {
        return DB::table('bm_groups')->where('bm_groups.group_id','=',$id)->first();
    }

    public function update($id,$data) {
        DB::table('bm_groups')->where('bm_groups.group_id','=',$id)->update($data);
    }

    public function confirm($id,$user_id,$name) {

        $db_source = DB::table('bm_users');

        if (!empty($user_id)) {
            $db_source->where('bm_users.user_id','=',$user_id);
        }

        if (!empty($name)) {
            $db_source->where('bm_users.name','LIKE',"%$name%");
        }
        
        return $db_source->where('bm_users.group_id','=',$id)->where('bm_users.status','!=','3')->select('bm_users.user_id','bm_users.name');
    }
}
