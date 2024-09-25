<?php

namespace App\Providers;

use App\Repositories\Constracts\Repository\CategoryRepository;
use App\Repositories\Constracts\RepositoryInterface\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
