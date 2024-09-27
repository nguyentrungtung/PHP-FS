<?php

namespace App\Http\View\Composers;

use App\Http\Controllers\CartController;
use Illuminate\View\View;
use App\Http\Controllers\CategoriesController;

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
        $cart = count($this->cartController->index());
        // dd($cart);
        $view->with('categories', $categories)->with('cart', $cart);
    }
}
