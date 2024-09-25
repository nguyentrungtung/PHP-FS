<?php

namespace App\Providers;

use App\Repositories\Constracts\Repository\CategoryRepository;
use App\Repositories\Constracts\RepositoryInterface\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\Contracts\Repository\CouponRepository;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        //
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrapFive();
    }
}
