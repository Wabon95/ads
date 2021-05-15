<?php

$router = new AltoRouter();
$router->addMatchTypes(['ad_slug' => '[a-zA-Z0-9-]+']);
// Homepage
$router->map('GET', '/', 'App\Controller\HomeController#home');

// Register
$router->map('GET', '/inscription', 'App\Controller\AuthController#registerView');
$router->map('POST', '/inscription', 'App\Controller\AuthController#registerTreatment');

// Login
$router->map('GET', '/connexion', 'App\Controller\AuthController#loginView');
$router->map('POST', '/connexion', 'App\Controller\AuthController#loginTreatment');

// Logout
$router->map('GET', '/deconnexion', 'App\Controller\AuthController#logout');

// Profile
$router->map('GET', '/profil', 'App\Controller\AuthController#profileView');
$router->map('POST', '/profil', 'App\Controller\AuthController#profileTreatment');

// Ads
$router->map('GET', '/annonce/ajouter', 'App\Controller\AdController#addView');
$router->map('POST', '/annonce/ajouter', 'App\Controller\AdController#addTreatment');
$router->map('GET', '/annonce/[ad_slug:slug]', 'App\Controller\AdController#viewOne');
$router->map('GET', '/annonces/', 'App\Controller\AdController#viewAll');


return $router;