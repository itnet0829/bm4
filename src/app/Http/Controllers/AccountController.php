<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountDestoryRequest;
use Illuminate\Http\Request;
use App\Services\AccountService\IAccountService;
use App\Http\Requests\AccountUpdateRequest;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\StatusChangeRequest;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AccountController extends Controller
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
     * アカウント情報を表示する
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $telephone_number = $request->input('telephone_number');

        $accounts = $this->service->view($user_id,$name,$email,$telephone_number)->paginate(100);
        return view('accounts.view',compact('accounts','user_id','name','email','telephone_number'));
    }

    public function create()
    {
        $groups = $this->service->group();
        $roles = $this->service->role();
        return view('accounts.create',compact('groups','roles'));
    }

    public function edit(int $id)
    {
        if ($id == null) {
            return view('accounts.view')->with('error','指定のデータが見つかりませんでした。');
        }
        $accounts = $this->service->edit($id);
        $groups = $this->service->group();
        $roles = $this->service->role();
        return view('accounts.edit',compact('accounts','groups','roles'));
    }

    public function store(AccountStoreRequest $request) 
    {
        $EDIT_KEYS = ["name","email","telephone_number","encrypted_password","group_id","member_limit_id","memo"];
        $B365_EDIT_KEYS = ["bet365_userid","bet365_enc_password"];

        $credentials = $request->only($EDIT_KEYS);
        $b365crs = $request->only($B365_EDIT_KEYS);

        $radio_due = $request->playdue;

        if ($radio_due == 1) {
            $num = $request->num_due;

            $credentials["license_deadline"] = date('Y-m-d 23:59:59',strtotime("+ ".$num."day"));
        } else if ($radio_due == 2) {
            $credentials["license_deadline"] = date('Y-m-d 23:59:59',strtotime($request->license_deadline));
        }

        $result = $this->service->store($credentials,$b365crs);

        if ($result == 500) {
            return redirect('accounts/create')->with('error','メールアドレスが重複しているため、登録できませんでした。');
        }

        return redirect('accounts')->with('message','アカウントを登録しました。');
    }

    public function update(AccountUpdateRequest $request, int $id)
    {
        if ($id == null) {
            return view('accounts.view')->with('error','指定のデータが見つかりませんでした。');
        }

        $EDIT_KEYS = ["group_id","member_limit_id","memo"];

        $credentials = $request->only($EDIT_KEYS);

        if ($request->playdue == 0) {
            $credentials["license_deadline"] = null;
        } else if ($request->playdue == 1) {
            $credentials["license_deadline"] = date('Y-m-d 23:59:59',strtotime($request->license_deadline));
        }

        $this->service->update($id,$credentials);

        return redirect('accounts')->with('message','アカウントを更新しました。');
    }

    public function status_change(StatusChangeRequest $request, int $id) {
        if ($id == null) {
            return view('accounts.view')->with('error','指定のデータが見つかりませんでした。');
        }

        $EDIT_KEYS = ["status"];

        $credentials = $request->only($EDIT_KEYS);

        $adm = $this->service->statusChange($id,$credentials);

        if ($adm == 0) {
            return redirect('accounts')->with('message','アカウントのロックを解除しました。');
        } else {
            return redirect('accounts')->with('message','アカウントをロックしました。');
        }
    }

    public function destroy(AccountDestoryRequest $request, int $id) {
        if ($id == null) {
            return view('accounts.view')->with('error','指定のデータが見つかりませんでした。');
        }

        $EDIT_KEYS = ["status"];

        $credentials = $request->only($EDIT_KEYS);

        if ($credentials["status"] == 3) {
            $this->service->destroy($id,$credentials);
            return redirect('accounts')->with('message','アカウントを削除しました。');
        } else {
            return redirect('accounts')->with('error','PERMISSION_DENIED_ERROR');
        }
    }

    public function csv_exports() {
        $accounts = $this->service->csv_output()->get();

        $csvHeader = ['UID', '作成日', '名前', 'メールアドレス', '電話番号','グループ','制限','利用期限','ログイン回数','メモ','ステータス'];
        $csvData = $accounts->toArray();

        $csv = $this->csv_export_fc($csvHeader,$csvData);


        return $csv;
    }

    private function csv_export_fc($csvHeader,$csvData) {
        $response = new StreamedResponse(function () use ($csvHeader, $csvData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, mb_convert_encoding($csvHeader, 'SJIS', 'auto'));

            foreach ($csvData as $row) {
                fputcsv($handle, mb_convert_encoding((array)$row, 'SJIS', 'auto'));
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users.csv"',
        ]);

        return $response;
    }
}
