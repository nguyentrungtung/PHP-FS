<?php

namespace App\Providers;

use App\Repositories\Contracts\Repository\ProductImageRepository;
use App\Repositories\Contracts\Repository\UnitValueRepository;
use App\Repositories\Contracts\RepositoryInterface\ProductImageRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitValueRepositoryInterface;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\ProductComposer;
use App\Http\View\Composers\ViewComposer;
use App\Repositories\Contracts\Repository\BrandRepository;
use App\Repositories\Contracts\Repository\CategoryRepository;
use App\Repositories\Contracts\Repository\CouponRepository;
use App\Repositories\Contracts\Repository\CustomersRepository;
use App\Repositories\Contracts\Repository\UnitRepository;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CustomersRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use App\Repositories\Contracts\Repository\ProductRepository;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;

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
        $this->app->bind(ProductRepositoryInterface::class,ProductRepository::class);
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);
        $this->app->bind(UnitRepositoryInterface::class,UnitRepository::class);
        $this->app->bind(CustomersRepositoryInterface::class,CustomersRepository::class);
        $this->app->bind(ProductImageRepositoryInterface::class,ProductImageRepository::class);
        $this->app->bind(UnitValueRepositoryInterface::class,UnitValueRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer(
            ['admin.products.create', 'admin.products.edit'], // Các view cần chia sẻ dữ liệu
            ProductComposer::class
        );
        //
        View::composer(['*', '!admin/*'],
        ViewComposer::class);
    }
}
