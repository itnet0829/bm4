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
    public function index()
    {
        $groups = $this->service->view();
        return view('groups.view',compact('groups'));
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

    public function confirm(int $id)
    {
        $groups = $this->service->edit($id);
        $users = $this->service->confirm($id);
        return view('groups.confirm',compact('users','groups'));
    }
}
