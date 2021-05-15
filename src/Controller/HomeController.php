<?php

namespace App\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $this->render('home', [
            'page_title' => 'Accueil'
            ]);
    }
}