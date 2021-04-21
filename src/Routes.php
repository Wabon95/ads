<?php

$router = new AltoRouter();
$router->addMatchTypes(['ad_slug' => '[a-zA-Z0-9-]+']);
// Homepage
$router->map('GET', '/', 'App\Controller\HomeController#home');

// Register
$router->map('GET', '/inscription', 'App\Controller\AuthController#register_view');
$router->map('POST', '/inscription', 'App\Controller\AuthController#register_treatment');

// Login
$router->map('GET', '/connexion', 'App\Controller\AuthController#login_view');
$router->map('POST', '/connexion', 'App\Controller\AuthController#login_treatment');

// Logout
$router->map('GET', '/deconnexion', 'App\Controller\AuthController#logout');

// Profile
$router->map('GET', '/profil', 'App\Controller\AuthController#profile_view');
$router->map('POST', '/profil', 'App\Controller\AuthController#profile_treatment');

// Ads
$router->map('GET', '/annonce/ajouter', 'App\Controller\AdController#add_view');
$router->map('POST', '/annonce/ajouter', 'App\Controller\AdController#add_treatment');
$router->map('GET', '/annonce/[ad_slug:slug]', 'App\Controller\AdController#viewOne');
$router->map('GET', '/annonces/', 'App\Controller\AdController#viewAll');


return $router;