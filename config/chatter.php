<?php

return [


    /*
    |--------------------------------------------------------------------------
    | Forum Routes
    |--------------------------------------------------------------------------
    |
    | Here you can specify the specific routes for the different sections of
    | your forum.
    |
    */

    'routes' => [
        'home' => 'forum',
        'discussion' => 'discussion',
        'category' => 'category'
    ],

    'titles' => [
        'discussion' => 'Discussion',
        'category' => 'Category',
    ],

    /*
    |--------------------------------------------------------------------------
    | The main headline and description of your forum
    |--------------------------------------------------------------------------
    |
    | Your headline and your description will be shown on the homepage of your
    | forum, unless you change the default theme.
    |
    */
    
    'headline' => 'Welcome to Chatter',
    'description' => 'A simple forum package for your Laravel app.',

    /*
    |--------------------------------------------------------------------------
    | Header and Footer Yield Inserts for your master file
    |--------------------------------------------------------------------------
    |
    | Chatter needs to add css or javascript to the header and footer of your 
    | master layout file. You can choose what these will be called. FYI, 
    | chatter will only load resources when you hit a forum route.
    |
    */

    'yields' => [
        'head' => 'css',
        'footer' => 'js'
    ]

];