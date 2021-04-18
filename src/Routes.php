<?php

$router = new AltoRouter();

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



return $router;