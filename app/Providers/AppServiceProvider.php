<?php

namespace App\Providers;

<<<<<<< Updated upstream
use App\Repositories\Contracts\Repository\BrandRepository;
use App\Repositories\Contracts\Repository\CategoryRepository;
use App\Repositories\Contracts\Repository\CouponRepository;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
=======
use App\Repositories\Contracts\Repository\CategoryRepository;
use App\Repositories\Contracts\Repository\CouponRepository;
use App\Repositories\Contracts\Repository\ProductRepository;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\CouponRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Pagination\Paginator;
>>>>>>> Stashed changes
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
<<<<<<< Updated upstream
        //
        $this->app->bind(CouponRepositoryInterface::class, CouponRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);
=======
        $repositories = [
            CouponRepositoryInterface::class => CouponRepository::class,
            ProductRepositoryInterface::class => ProductRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
        ];

        foreach ($repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
>>>>>>> Stashed changes
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
