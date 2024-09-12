<?php

namespace Core;

class Controller {
   
    public function view($view, $data = []) {
        $content = '../app/Views/' . $view . '.php';
        
        require_once '../app/Views/layouts/dashboard.php';
    }
    
}
