# Chatter

[![Build Status](https://travis-ci.org/thedevdojo/chatter.svg?branch=master)](https://travis-ci.org/thedevdojo/chatter)
[![Built For Laravel](https://img.shields.io/badge/built%20for-laravel-blue.svg)](http://laravel.com)

![](https://raw.githubusercontent.com/thedevdojo/chatter/master/public/assets/images/chatter.jpg)

### Installation

Quick Note: If this is a new project, make sure to install the default user authentication provided with Laravel. `php artisan make:auth`

1. Include the package in your project

    ```
    composer require "devdojo/chatter=0.1.*"
    ```

2. Add the service provider to your `config/app.php` providers array:

    ```
    DevDojo\Chatter\ChatterServiceProvider::class,
    ```

3. Publish the Vendor Assets files by running:

    ```
    php artisan vendor:publish
    ```

4. Now that we have published a few new files to our application we need to reload them with the following command:

    ```
    composer dump-autoload
    ```

5. Run Your migrations:

    ```
    php artisan migrate
    ```

    Quick tip: Make sure that you've created a database and added your database credentials in your `.env` file.

6. Lastly, run the seed files to seed your database with a little data:

    ```
    php artisan db:seed --class=ChatterTableSeeder
    ```

7. Inside of your master.blade.php file include a header and footer yield. Inside the head of your master or app.blade.php add the following:

    ```
    @yield('css')
    ```

    Then, right above the `</body>` tag of your master file add the following:

    ```
    @yield('js')
    ```

Now, visit your site.com/forums and you should see your new forum in front of you!

### VIDEOS

[Introduction and Installation of Chatter](https://devdojo.com/episode/create-a-laravel-forum)

### Configuration

When you published the vendor assets you added a new file inside of your `config` folder which is called `config/chatter.php`. This file contains a bunch of configuration you can use to configure your forums

### Customization

*CUSTOM CSS*

If you want to add additional style changes you can simply add another stylesheet at the end of your `@yield('css')` statement in the head of your master file. In order to only load this file when a user is accessing your forums you can include your stylesheet in the following `if` statement:

```
@if(Request::is( Config::get('chatter.routes.home') ) || Request::is( Config::get('chatter.routes.home') . '/*' ))
    <!-- LINK TO YOUR CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="/assets/css/forums.css" />
@endif
```

*SEO FRIENDLY PAGE TITLES*

Since the forum uses your master layout file, you will need to include the necessary code in order to display an SEO friendly title for your page. The following code will need to be added to the `<head>` of your master file:

```
@if( Request::is( Config::get('chatter.routes.home')) )
    <title>Title for your forum homepage -  Website Name</title>
@elseif( Request::is( Config::get('chatter.routes.home') . '/*' ) && isset($discussion->title))
    <title>{{ $discussion->title }} - Website Name</title>
@endif
```

### Custom Function Hooks for the forum

Sometimes you may want to add some additional functionality when a user creates a new discussion or adds a new response. Well, there are a few built in functions that you can create in your script to access this functionality:

*Before User Adds New Discussion*
Create a new global function in your script called:
```
function chatter_before_new_discussion($request, $validator){}
```

Note: that the `$request` object is passed with the user input for each webhook. You can use it if you would like :) If not, no worries just add your custom functionality.

*After User Adds New Discussion*
Create a new global function in your script called:
```
function chatter_after_new_discussion($request){}
```

*Before User Adds New Response*
Create a new global function in your script called:
```
function chatter_before_new_response($request, $validator){}
```

*After User Adds New Response*
Create a new global function in your script called:
```
function chatter_after_new_response($request){}
```

### Screenshots

![](https://raw.githubusercontent.com/thedevdojo/chatter/master/public/assets/images/chatter-screenshot.jpg)
