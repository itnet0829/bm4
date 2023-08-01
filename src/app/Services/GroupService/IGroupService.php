<?php

namespace App\Services\GroupService;

use App\Services\IService;
use Illuminate\Support\Collection;

interface IGroupService extends IService
{   
    public function view($group_id,$group_name,$administrator_name);

    public function store($data);

    public function edit($id);
    
    public function update($id,$data);

    public function confirm($id,$user_id,$name);
}