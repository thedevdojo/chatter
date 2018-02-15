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
        'home'       => 'forums',
        'discussion' => 'discussion',
        'category'   => 'category',
        'post'       => 'posts',
        'register'   => 'register',
        'login'      => 'login',
    ],

   /*
    |--------------------------------------------------------------------------
    | Headline logo
    |--------------------------------------------------------------------------
    |
    | Specify the url for your logo. If left empty the headline and
    | description from the language files will be used.
    |
    |   *headline_logo*: If this is set an image will be used on the forum home
    |       instead of text. Specify the relative path to the image here.
    |
    */

    'headline_logo' => '/vendor/devdojo/chatter/assets/images/logo-light.png',

    /*
    |--------------------------------------------------------------------------
    | Header and Footer Yield Inserts for your master file
    |--------------------------------------------------------------------------
    |
    | Chatter needs to add css or javascript to the header and footer of your
    | master layout file. You can choose what these will be called. FYI,
    | chatter will only load resources when you hit a forum route.
    |
    | example:
    | Inside of your <head></head> tag of your master file, you'll need to
    | include @yield('css').
    |
    | Next, before the ending body </body>, you will need to include the footer
    | yield like so @yield('js')
    |
    */

    'yields' => [
        'head'   => 'css',
        'footer' => 'js',
    ],

    /*
    |--------------------------------------------------------------------------
    | The master layout file for your site
    |--------------------------------------------------------------------------
    |
    | By default Laravel's master file is the layouts.app file, but if your
    | master layout file is somewhere else, you can specify it below
    |
    */

    'master_file_extend' => 'layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Sidebar option in discussion view
    |--------------------------------------------------------------------------
    |
    | By default the sidebar is only included in home.blade.php
    | if you set the value to true, it will also be included in
    | discussion.blade.php
    |
    */

    'sidebar_in_discussion_view' => false,

    /*
    |--------------------------------------------------------------------------
    | Information about the forum User
    |--------------------------------------------------------------------------
    |
    | Your forum needs to know specific information about your user in order
    | to confirm that they are logged in and to link to their profile.
    |
    |   *namespace*: This is the user namespace for your User Model.
    |
    |   *database_field_with_user_name*: This is the database field that
    |       is used for the users 'Name', could be 'username', 'first_name'.
    |       This will appear next to the user's avatar in discussions
    |
    |   *relative_url_to_profile*: Users may want to click on another users
    |       image to view their profile. If a users profile page is at
    |       /profile/{username} you will add '/profile/{username}' or
    |       if it is /profile/{id}, you will specify '/profile/{id}'. You are
    |       only able to specify 1 url parameter.
    |       Tip: leave this blank and no link will be generated
    |
    |   *relative_url_to_image_assets*: This is where your image assets are
    |       located. This will be used with the 'avatar_image_database_field'
    |       so if your image assets are located at '/uploads/images/' and
    |       the 'avatar_image_database_field' contains 'avatars/johndoe.jpg'
    |       the full image url will be '/uploads/images/avatar/johndoe.jpg'
    |       Tip: leave this blank if you have absolute url's for images
    |       stored in the database.
    |
    |   *avatar_image_database_field*: This is the database field that
    |       contains the logged in user avatar image. This field will
    |       be inside of the 'users' database table. Tip: leave this
    |       empty if you want to keep the default color circles with
    |       users first initial.
    |
    */

    'user' => [
        'namespace'                     => 'App\User',
        'database_field_with_user_name' => 'name',
        'relative_url_to_profile'       => '',
        'relative_url_to_image_assets'  => '',
        'avatar_image_database_field'   => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | A Few security measures to prevent spam on your forum
    |--------------------------------------------------------------------------
    |
    | Here are a few configurations that you can add to your forum to prevent
    | possible spammers or bots.
    |
    |   *limit_time_between_posts*: Stop user from being able to spam by making
    |       them wait a specified time before being able to post again.
    |
    |   *time_between_posts*: In minutes, the time a user must wait before
    |       being allowed to add more content. Only valid if above value is
    |       set to true.
    |
    */

    'security' => [
        'limit_time_between_posts' => true, //
        'time_between_posts'       => 1, // In minutes
    ],

    /*
    |--------------------------------------------------------------------------
    | Chatter Editor
    |--------------------------------------------------------------------------
    |
    | You may wish to choose between a couple different editors. At the moment
    | The following editors are supported:
    |   - tinymce    (https://www.tinymce.com/)
    |   - simplemde  (https://simplemde.com/)
    |   - trumbowyg  (https://alex-d.github.io/Trumbowyg/) - requires jQuery >= 1.8
    |
    */

    'editor' => 'tinymce',

    /*
    |--------------------------------------------------------------------------
    | TinyMCE WYSIWYG Editor Options (Must be the selected editor)
    |--------------------------------------------------------------------------
    |
    | Select which tools you want to appear in the tinymce editor toolbar.
    | Find out the available tools here:
    | tinymce.com/docs/advanced/editor-control-identifiers/#toolbarcontrols
    |
    |   *toolbar*: The controls you want to appear in the toolbar
    |
    |   *plugins*: Sometimes in order to add a control to the toolbar you may
    |       need to specify to include the plugin for the control. You can
    |       learn more about this in the link above. If it is part of the
    |       'core' you do not need to include a plugin in order to use it
    |       in the toolbar.
    |
    */

    'tinymce' => [
        'toolbar' => 'bold italic underline | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
        'plugins' => 'link, image',
    ],

    /*
    |--------------------------------------------------------------------------
    | Default orderby
    |--------------------------------------------------------------------------
    |
    | This determines how the Discussions will be ordered on the home screen
    |
    */

    'order_by' => [
        'posts' => [
            'order' => 'created_at',
            'by' => 'ASC'
        ],
        'discussions' => [
            'order' => 'last_reply_at',
            'by' => 'DESC'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Notification Settings
    |--------------------------------------------------------------------------
    |
    | The following are settings that you can use to modify the email settings
    |   - enabled (if you would like to enable or disable email notifications)
    |   - view (the email view sent) $discussion var is passed to view
    |   -
    |
    */

    'email' => [
        'enabled' => false,
        'view'    => 'chatter::email',
    ],

    /*
    |--------------------------------------------------------------------------
    | Use Soft Deletes
    |--------------------------------------------------------------------------
    |
    | Setting this to true will mean when a post gets deleted the `deleted_at`
    | date gets set but the actual row in the database does not get deleted.
    | This is useful for forum moderation and history retention
    |
    */

    'soft_deletes' => false,

    /*
    |--------------------------------------------------------------------------
    | Pagination Settings
    |--------------------------------------------------------------------------
    |
    | These are the pagination settings for your forum. Specify how many number
    | of results you want to show per page.
    |
    */

    'paginate' => [
        'num_of_results' => 10,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Show missing fields to users in forms
    |--------------------------------------------------------------------------
    |
    | This usually has to be active to show the users what they are missing
    | unless you want to manage by your own system in the master template
    |
    */

    'errors' => true,

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | Configure the middleware applied to specific routes across Chatter. This
    | gives you full control over middleware throughout your application. You
    | can allow public access to everything or limit to specific routes.
    |
    | Authentication is enforced on create, store, edit, update, destroy routes,
    | no need to add 'auth' to these routes.
    |
    */

    'middleware' => [
        'global'     => ['web'],
        'home'       => [],
        'discussion' => [
            'index'   => [],
            'show'    => [],
            'create'  => [],
            'store'   => [],
            'destroy' => [],
            'edit'    => [],
            'update'  => [],
        ],
        'post' => [
            'index'   => [],
            'show'    => [],
            'create'  => [],
            'store'   => [],
            'destroy' => [],
            'edit'    => [],
            'update'  => [],
        ],
        'category' => [
            'show' => [],
        ],
    ],
];
