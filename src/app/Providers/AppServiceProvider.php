<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    const INTERFACE = 0;
    const IMPLEMENTS = 1;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $bindings = $this->getServicesToBind();
        $bindings->each(function ($binding) {
            $this->app->bind($binding[self::INTERFACE], $binding[self::IMPLEMENTS]);
        });
    }

    private function getServicesToBind(): Collection
    {
        return collect([
            [
                \App\Services\AccountService\IAccountService::class,
                \App\Services\AccountService\AccountService::class
            ],
            [
                \App\Services\GroupService\IGroupService::class,
                \App\Services\GroupService\GroupService::class
            ],
            [
                \App\Services\PushService\IPushService::class,
                \App\Services\PushService\PushService::class
            ]
        ]);
    }



    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
