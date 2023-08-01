<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PushService\IPushService;
use App\Http\Requests\PushStoreRequest;
use Illuminate\Support\Str;

class PushController extends Controller
{

    private $service;

    /**
     * @param IPushService      $service     IPushService
     */

    public function __construct(
        IPushService $service
    ) {
        $this->service = $service;
    }

    /**
     * PUSHメッセージ一覧を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $push_id = $request->input('push_id');
        $title = $request->input('title');
        $all_broadcasted_message = $this->service->get_broadcasted_message($push_id,$title)->paginate(100);
        return view('push.view',compact('all_broadcasted_message','push_id','title'));
    }

    public function confirm(int $id)
    {
        $push = $this->service->confirm_push_data($id);

        if ($push->all_pushing != true) {
            if ($push->group_id){
                $get_group = $this->service->get_confirm_group($push->pushcode)->paginate(20);
                return view('push.confirm',compact('push','get_group'));
            } else if ($push->user_id) {
                $get_user = $this->service->get_confirm_user($push->pushcode)->paginate(20);
                return view('push.confirm',compact('push','get_user'));
            }
        } else {
            return view('push.confirm',compact('push'));
        }
    }

    public function create()
    {
        $account = $this->service->get_accounts();
        $group   = $this->service->get_groups();
        return view('push.create',compact('account','group'));
    }

    public function store(PushStoreRequest $request)
    {
        $EDIT_KEYS = ["subjects","message","start_broadcasting_time"];
        $credentials = $request->only($EDIT_KEYS);

        $credentials['pushcode'] = Str::random(16);

        $sender = $request->sender;

        if ($sender == 0) {
            $credentials["all_pushing"] = true;
            $this->service->store($credentials);
        } else if ($sender == 1) {
            $group_data = $request['check-group'];
            $credentials["all_pushing"] = false;
            foreach ($group_data as $gd) {
                $credentials['group_id'] = $gd;
                $this->service->store($credentials);
            }
        } else if ($sender == 2) {
            $user_data = $request['check-user'];
            $credentials["all_pushing"] = false;
            foreach ($user_data as $ud) {
                $credentials['user_id'] = $ud;
                $this->service->store($credentials);
            }
        }

        return redirect('push')->with('message','通知を登録しました。');
    }
}
