<?php
use Strange\Config\Autoloader;
use Strange\Config\Routeur;

define("ROOT", dirname(__FILE__).'\\');
require 'Config/Autoloader.php';
Autoloader::register();

/** Methodes du controleur welcomeController */
Routeur::get("/" , "welcome@connexion");
Routeur::get("/inscription" , "welcome@inscription");
Routeur::get('confirmtoken-{token}-{email}', 'welcome@confirmtoken')
    ->with('token', '[a-z0-9]+');
Routeur::get('/profile', 'user@index');
Routeur::get('/logout', 'user@logout');

Routeur::run();