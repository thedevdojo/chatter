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
    | The main editor for users to add text into the forum
    |--------------------------------------------------------------------------
    |
    | When a user creates a new discussion or responds to a thread/post this 
    | is the editor that they will use. You can choose between 'tinymce',
    | 'medium' (inline editor), or 'markdown'.
    |
    */

    'editor' => 'tinymce',
    
    'headline' => 'Welcome to Chatter',
    'description' => 'A simple forum package for your Laravel app.'

];