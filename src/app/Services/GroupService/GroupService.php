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
    public function view() {
        return DB::table('bm_groups')->get();
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

    public function confirm($id) {
        return DB::table('bm_users')->where('bm_users.group_id','=',$id)->where('bm_users.status','!=','3')->select('bm_users.user_id','bm_users.name')->get();
    }
}
