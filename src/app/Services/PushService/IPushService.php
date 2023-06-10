<?php

namespace App\Services\PushService;

use App\Services\IService;
use Illuminate\Support\Collection;

interface IPushService extends IService
{   

    public function get_broadcasted_message();

    public function get_accounts();

    public function get_groups();

    public function store($data);

    public function confirm_push_data($id);

    public function get_confirm_group($pc);

    public function get_confirm_user($pc);
}