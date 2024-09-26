<?php

namespace App\Providers;

use App\Repositories\Contracts\Repository\BrandRepository;
use App\Repositories\Contracts\Repository\CategoryRepository;
use App\Repositories\Contracts\Repository\CouponRepository;
use App\Repositories\Contracts\Repository\UnitRepository;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);
        $this->app->bind(UnitRepositoryInterface::class,UnitRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
