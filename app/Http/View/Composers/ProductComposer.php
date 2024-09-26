<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;

class ProductComposer
{
    private $categoryRepositoryInterface;
    private $brandRepositoryInterface;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        BrandRepositoryInterface $brandRepositoryInterface
    )
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->brandRepositoryInterface = $brandRepositoryInterface;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryRepositoryInterface->all();
        $brands = $this->brandRepositoryInterface->all();

        $view->with('categories', $categories)
            ->with('brands', $brands);
    }
}
