<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

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
        Paginator::useBootstrap();

        /**
         * Collectionに対して paginate できるようにするマクロ
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
