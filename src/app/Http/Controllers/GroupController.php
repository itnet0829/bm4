<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService\IGroupService;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;

class GroupController extends Controller
{

    private $service;

    /**
     * @param IGroupService      $service     TicketService
     */

    public function __construct(
        IGroupService $service,
    ) {
        $this->service = $service;
    }
    public function index(Request $request)
    {
        $group_id = $request->input('group_id');
        $group_name = $request->input('group_name');
        $administrator_name = $request->input('administrator_name');
        $groups = $this->service->view($group_id,$group_name,$administrator_name)->paginate(100);
        return view('groups.view',compact('groups','group_id','group_name','administrator_name'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(GroupStoreRequest $request)
    {
        $EDIT_KEYS = ["group_name","administrator_name"];
        $credentials = $request->only($EDIT_KEYS);
        $this->service->store($credentials);
        return redirect('groups')->with('message','グループ情報を登録しました。');
    }

    public function edit(int $id)
    {
        $groups = $this->service->edit($id);
        return view('groups.edit',compact('groups'));
    }

    public function update(GroupUpdateRequest $request, int $id)
    {
        $EDIT_KEYS = ["group_name","administrator_name"];
        $credentials = $request->only($EDIT_KEYS);
        $this->service->update($id,$credentials);
        return redirect('groups')->with('message','グループ情報を更新しました。');
    }

    public function confirm(Request $request, int $id)
    {
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $groups = $this->service->edit($id);
        $users = $this->service->confirm($id,$user_id,$name)->paginate(100);
        return view('groups.confirm',compact('users','groups','user_id','name'));
    }
}
