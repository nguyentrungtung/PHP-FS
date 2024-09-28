<?php

namespace App\Http\View\Composers;
use App\Http\Controllers\Home\Carttemp;
use App\Http\Controllers\Home\CategoriesController;
use Illuminate\View\View;

class ViewComposer
{
    private $categoriesController;
    private $cartController;
    //
    public function __construct(CategoriesController $categoriesController,CartController $cartController) {
        $this->categoriesController = $categoriesController;
        $this->cartController = $cartController;
    }

    public function compose(View $view)
    {
        $categories = $this->categoriesController->index();
        $totalCart = count(session()->get('cart',[]));
        $carts = session()->get('cart', []);

        $view->with(compact('categories', 'carts', 'totalCart'));
    }
}
