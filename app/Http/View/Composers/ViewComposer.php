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
    public function __construct(CategoriesController $categoriesController,Carttemp $cartController) {
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
