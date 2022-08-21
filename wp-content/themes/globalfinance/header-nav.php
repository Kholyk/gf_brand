<?php
require 'general.php';

$tplDir = get_theme_root_uri() . '/globalfinance/';

$currentNavLinks = [];

$navLinksArr = array_map(
    function ($name, $destination) use (&$currentNavLinks) {
        return $currentNavLinks[$name] = get_home_url() . $destination;
    },
    array_keys($navbarLinks),
    $navbarLinks
);

$navMenu = new Navbar(
    [
    'type' => 'navbar',
    'logo' => '/wp-content/uploads/logo/logo-string-black.svg',
    'menuItems' => $currentNavLinks,
    'menuOptions' => [  
        //Choose from: Light, dark, warning, info ... danger
        'bg' => 'success',
        
        //Choose from: Fixed-top, fixed-bottom, sticky-top
        'navType' => 'sticky-top',
    ],

    // Social media icons in navbar
    'social' => $social ?? []
    ]
);

$navMenu->makeSection();