<?php

namespace App\Services\GroupService;

use App\Services\IService;
use Illuminate\Support\Collection;

interface IGroupService extends IService
{   
    public function view();

    public function store($data);

    public function edit($id);
    
    public function update($id,$data);

    public function confirm($id);
}