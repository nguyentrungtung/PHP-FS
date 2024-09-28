<?php

namespace App\Http\View\Composers;

use App\Http\Controllers\Home\CartController;
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
        $count = $this->cartController->count();
        // dd($cart);
        $view->with('categories', $categories)->with('count', $count);
    }
}
