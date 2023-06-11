<?php

namespace App\Services\AccountService;

use App\Services\IService;
use Illuminate\Support\Collection;

interface IAccountService extends IService
{   
    public function view();

    public function activates_account_view();

    public function edit($id);

    public function store($data,$b365data);

    public function update($id,$data);

    public function statusChange($id,$data);

    public function destroy($id,$data);

    public function group();

    public function role();
}