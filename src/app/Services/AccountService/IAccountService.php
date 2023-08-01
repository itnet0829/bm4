<?php

namespace App\Services\AccountService;

use App\Services\IService;
use Illuminate\Support\Collection;

interface IAccountService extends IService
{   
    public function view($user_id,$name,$email,$telephone_number);

    public function activates_account_view($user_id,$name,$email,$telephone_number);

    public function edit($id);

    public function store($data,$b365data);

    public function update($id,$data);

    public function statusChange($id,$data);

    public function destroy($id,$data);

    public function csv_output();

    public function group();

    public function role();
}