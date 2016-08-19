# Chatter

![](https://raw.githubusercontent.com/thedevdojo/chatter/master/public/assets/images/chatter.jpg)

### Installation

Quick Note: If this is a new project, make sure to insall the default user authentication provided with Laravel. `php artisan make:auth`

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

### Configuration

When you published the vendor assets you added a new file inside of your `config` folder which is called `config/chatter.php`. This file contains a bunch of configuration you can use to configure your forums

### Customization

If you want to add additional style changes you can simply add another stylesheet at the end of your `@yield('css')` statement in the head of your master file. In order to only load this file when a user is accessing your forums you can include your stylesheet in the following `if` statement:

```
@if(Request::is( Config::get('chatter.routes.home') ) || Request::is( Config::get('chatter.routes.home') . '/*' ))
    <!-- LINK TO YOUR CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="/assets/css/forums.css" />
@endif
```

### Screenshots

![](https://raw.githubusercontent.com/thedevdojo/chatter/master/public/assets/images/chatter-screenshot-1.jpg)

![](https://raw.githubusercontent.com/thedevdojo/chatter/master/public/assets/images/chatter-screenshot-2.jpg)
