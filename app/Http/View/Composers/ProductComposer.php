<?php

namespace App\Http\View\Composers;

use App\Repositories\Contracts\RepositoryInterface\UnitRepositoryInterface;
use Illuminate\View\View;
use App\Repositories\Contracts\RepositoryInterface\CategoryRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface\BrandRepositoryInterface;

class ProductComposer
{
    private $categoryRepositoryInterface;
    private $brandRepositoryInterface;
    private UnitRepositoryInterface $unitRepositoryInterface;

    public function __construct(
        CategoryRepositoryInterface $categoryRepositoryInterface,
        BrandRepositoryInterface    $brandRepositoryInterface,
        UnitRepositoryInterface     $unitRepositoryInterface
    )
    {
        $this->categoryRepositoryInterface = $categoryRepositoryInterface;
        $this->brandRepositoryInterface = $brandRepositoryInterface;
        $this->unitRepositoryInterface = $unitRepositoryInterface;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryRepositoryInterface->all();
        $brands = $this->brandRepositoryInterface->all();
        $units = $this->unitRepositoryInterface->all();

        $view->with(compact('categories', 'brands', 'units'));
    }
}
