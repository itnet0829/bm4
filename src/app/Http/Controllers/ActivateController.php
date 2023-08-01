<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountDestoryRequest;
use App\Http\Requests\StatusChangeRequest;

use App\Services\AccountService\IAccountService;

class ActivateController extends Controller
{

    private $service;

    /**
     * @param IAccountService      $service     TicketService
     */

     public function __construct(
        IAccountService $service,
    ) {
        $this->service = $service;
    }

    /**
     * アクティベート情報を調べる。
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $telephone_number = $request->input('telephone_number');

        $accounts = $this->service->activates_account_view($user_id,$name,$email,$telephone_number)->paginate(100);
        return view('activates.view',compact('accounts','user_id','name','email','telephone_number'));
    }

    public function destroy(AccountDestoryRequest $request, int $id) {
        if ($id == null) {
            return view('activates.view')->with('error','指定のデータが見つかりませんでした。');
        }

        $EDIT_KEYS = ["status"];

        $credentials = $request->only($EDIT_KEYS);

        if ($credentials["status"] == 3) {
            $this->service->destroy($id,$credentials);
            return redirect('activates')->with('message','アカウントを削除しました。');
        } else {
            return redirect('activates')->with('error','PERMISSION_DENIED_ERROR');
        }
    }

    public function unlock(StatusChangeRequest $request, int $id){
        if ($id == null) {
            return view('activates.view')->with('error','指定のデータが見つかりませんでした。');
        }

        $EDIT_KEYS = ["status"];

        $credentials = $request->only($EDIT_KEYS);

        $adm = $this->service->statusChange($id,$credentials);

        if ($adm == 0) {
            return redirect('activates')->with('message','アカウントのロックを解除しました。');
        } else {
            return redirect('activates')->with('message','アカウントをロックしました。');
        }
    }
}
