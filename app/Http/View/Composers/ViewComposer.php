<?php

namespace App\Http\View\Composers;
use App\Http\Controllers\Home\CartController;
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
        $totalCart = count(session()->get('carts',[]));
        $carts = session()->get('carts', []);
        $historySearch=session()->get('search',[]);
        // dd($historySearch);
        $view->with(compact('categories', 'carts', 'totalCart','historySearch'));
    }
}
