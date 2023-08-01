<?php

declare(strict_types=1);

namespace App\Services\PushService;
use Illuminate\Support\Str;

use Exception;
use Illuminate\Support\Facades\DB;

class PushService implements IPushService
{

    public function get_broadcasted_message($push_id,$title){
        $db_source = DB::table('push_notifies');

        if (!empty($push_id)) {
            $db_source->where('push_id','=',$push_id);
        }

        if (!empty($title)) {
            $db_source->where('subjects','LIKE',"%$title%");
        }

        return collect($db_source->get())->unique('pushcode');
    }
    public function get_accounts(){
        return DB::table('bm_users')->where('bm_users.status','=',0);
    }

    public function get_groups(){
        return DB::table('bm_groups');
    }

    public function store($data) {
        DB::table('push_notifies')->insert($data);
    }

    public function confirm_push_data($id){
        return DB::table('push_notifies as ps')
        ->where('ps.push_id','=',$id)
        ->select('ps.user_id','ps.group_id','ps.all_pushing','ps.subjects','ps.message','ps.pushcode','ps.start_broadcasting_time')
        ->first();
    }

    public function get_confirm_group($pc) {
        return DB::table('push_notifies as ps')
        ->where('ps.pushcode','=',$pc)
        ->join('bm_groups','ps.group_id','=','bm_groups.group_id')
        ->select('bm_groups.group_id','bm_groups.group_name')->get();
    }

    public function get_confirm_user($pc) {
        return DB::table('push_notifies as ps')
        ->where('ps.pushcode','=',$pc)
        ->join('bm_users','ps.user_id','=','bm_users.user_id')
        ->select('bm_users.user_id','bm_users.name')->get();
    }
}
