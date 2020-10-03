<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ForumTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {

        // CREATE THE USER

        if (!\DB::table('users')->find(1)) {
            \DB::table('users')->insert([
                0 => [
                    'id'             => 1,
                    'name'           => 'zbang',
                    'email'          => 'zbang@forum.dab',
                    'password'       => bcrypt('ganggang'),
                    'remember_token' => 'RvlORzs8dyG8IYqssJGcuOY2F0vnjBy2PnHHTX2MoV7Hh6udjJd6hcTox3un',
                    'created_at'     => '2016-07-29 15:13:02',
                    'updated_at'     => '2016-08-18 14:33:50',
                ],
            ]);
        }

        // CREATE THE CATEGORIES

        \DB::table('forum_categories')->delete();

        \DB::table('forum_categories')->insert([
            0 => [
                'id'         => 1,
                'parent_id'  => null,
                'order'      => 1,
                'name'       => 'Introductions',
                'color'      => '#3498DB',
                'slug'       => 'introductions',
                'created_at' => null,
                'updated_at' => null,
            ],
            1 => [
                'id'         => 2,
                'parent_id'  => null,
                'order'      => 2,
                'name'       => 'General',
                'color'      => '#2ECC71',
                'slug'       => 'general',
                'created_at' => null,
                'updated_at' => null,
            ],
            2 => [
                'id'         => 3,
                'parent_id'  => null,
                'order'      => 3,
                'name'       => 'Feedback',
                'color'      => '#9B59B6',
                'slug'       => 'feedback',
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id'         => 4,
                'parent_id'  => null,
                'order'      => 4,
                'name'       => 'Random',
                'color'      => '#E67E22',
                'slug'       => 'random',
                'created_at' => null,
                'updated_at' => null,
            ],
            4 => [
                'id'         => 5,
                'parent_id'  => 1,
                'order'      => 1,
                'name'       => 'Rules',
                'color'      => '#227ab5',
                'slug'       => 'rules',
                'created_at' => null,
                'updated_at' => null,
            ],
            5 => [
                'id'         => 6,
                'parent_id'  => 5,
                'order'      => 1,
                'name'       => 'Basics',
                'color'      => '#195a86',
                'slug'       => 'basics',
                'created_at' => null,
                'updated_at' => null,
            ],
            6 => [
                'id'         => 7,
                'parent_id'  => 5,
                'order'      => 2,
                'name'       => 'Contribution',
                'color'      => '#195a86',
                'slug'       => 'contribution',
                'created_at' => null,
                'updated_at' => null,
            ],
            7 => [
                'id'         => 8,
                'parent_id'  => 1,
                'order'      => 2,
                'name'       => 'About',
                'color'      => '#227ab5',
                'slug'       => 'about',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);

        // CREATE THE DISCUSSIONS

        \DB::table('forum_discussion')->delete();

        \DB::table('forum_discussion')->insert([
            0 => [
                'id'                  => 3,
                'forum_category_id' => 1,
                'title'               => 'Hello Everyone, This is my Introduction',
                'user_id'             => 1,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:27:56',
                'updated_at'          => '2016-08-18 14:27:56',
                'slug'                => 'hello-everyone-this-is-my-introduction',
                'color'               => '#239900',
            ],
            1 => [
                'id'                  => 6,
                'forum_category_id' => 2,
                'title'               => 'Login Information for Forum',
                'user_id'             => 1,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:39:36',
                'updated_at'          => '2016-08-18 14:39:36',
                'slug'                => 'login-information-for-forum',
                'color'               => '#1a1067',
            ],
            2 => [
                'id'                  => 7,
                'forum_category_id' => 3,
                'title'               => 'Leaving Feedback',
                'user_id'             => 1,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:42:29',
                'updated_at'          => '2016-08-18 14:42:29',
                'slug'                => 'leaving-feedback',
                'color'               => '#8e1869',
            ],
            3 => [
                'id'                  => 8,
                'forum_category_id' => 4,
                'title'               => 'Just a random post',
                'user_id'             => 1,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:46:38',
                'updated_at'          => '2016-08-18 14:46:38',
                'slug'                => 'just-a-random-post',
                'color'               => '',
            ],
            4 => [
                'id'                  => 9,
                'forum_category_id' => 2,
                'title'               => 'Welcome to the Forum Laravel Forum Package',
                'user_id'             => 1,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:59:37',
                'updated_at'          => '2016-08-18 14:59:37',
                'slug'                => 'welcome-to-the-forum-laravel-forum-package',
                'color'               => '',
            ],
        ]);

        // CREATE THE POSTS

        \DB::table('forum_post')->delete();

        \DB::table('forum_post')->insert([
                    0 => [
                        'id'                    => 1,
                        'forum_discussion_id' => 3,
                        'user_id'               => 1,
                        'body'                  => '<p>hi, what\'s up?</p>',
                        'created_at' => '2016-08-18 14:27:56',
                        'updated_at' => '2016-08-18 14:27:56',
                    ],
                    1 => [
                        'id'                    => 5,
                        'forum_discussion_id' => 6,
                        'user_id'               => 1,
                        'body'                  => '<p>Hey!</p>
        <p>Thanks again for checking out forum. If you want to login with the default user you can login with the following credentials:</p>
        <p><strong>email address</strong>: zbang@forum.dab</p>
        <p><strong>password</strong>: ganggang</p>
        <p>You\'ll probably want to delete this user, but if for some reason you want to keep it... Go ahead :)</p>',
                    'created_at' => '2016-08-18 14:39:36',
                    'updated_at' => '2016-08-18 14:39:36',
                ],
                2 => [
                    'id'                    => 6,
                    'forum_discussion_id' => 7,
                    'user_id'               => 1,
                    'body'                  => '<p>What a great place to share some ideas!</p>',
                'created_at' => '2016-08-18 14:42:29',
                'updated_at' => '2016-08-18 14:42:29',
            ],
            3 => [
                'id'                    => 7,
                'forum_discussion_id' => 8,
                'user_id'               => 1,
                'body'                  => '<p>This is just a random post to show you some of the formatting that you can do in the WYSIWYG editor. You can make your text <strong>bold</strong>, <em>italic</em>, or <span style="text-decoration: underline;">underlined</span>.</p>
        <p style="text-align: center;">Additionally, you can center align text.</p>
        <p style="text-align: right;">You can align the text to the right!</p>
        <p>Or by default it will be aligned to the left.</p>
        <ul>
        <li>We can also</li>
        <li>add a bulleted</li>
        <li>list</li>
        </ul>
        <ol>
        <li><span style="line-height: 1.6;">or we can</span></li>
        <li><span style="line-height: 1.6;">add a numbered list</span></li>
        </ol>
        <p style="padding-left: 30px;"><span style="line-height: 1.6;">We can choose to indent our text</span></p>
        <p><span style="line-height: 1.6;">Post links: <a href="http://themostseconds.com/" target="_blank">lol</a></span></p>
        <p><span style="line-height: 1.6;">and add images:</span></p>
        <p><span style="line-height: 1.6;"><img src="https://media.giphy.com/media/o0vwzuFwCGAFO/giphy.gif" alt="" width="300" height="300" /></span></p>',
                'created_at' => '2016-08-18 14:46:38',
                'updated_at' => '2016-08-18 14:46:38',
            ],
            4 => [
                'id'                    => 8,
                'forum_discussion_id' => 8,
                'user_id'               => 1,
            'body'                      => '<p>Haha :) Cats!</p>
        <p><img src="https://media.giphy.com/media/5Vy3WpDbXXMze/giphy.gif" alt="" width="250" height="141" /></p>
        <p><img src="https://media.giphy.com/media/XNdoIMwndQfqE/200.gif" alt="" width="200" height="200" /></p>',
            'created_at' => '2016-08-18 14:55:42',
            'updated_at' => '2016-08-18 15:45:13',
        ],
        5 => [
            'id'                    => 9,
            'forum_discussion_id' => 9,
            'user_id'               => 1,
            'body'                  => '<p>Hey There!</p>
        <p>Happy programming!</p>',
            'created_at' => '2016-08-18 14:59:37',
            'updated_at' => '2016-08-18 14:59:37',
        ],
        6 => [
            'id'                    => 10,
            'forum_discussion_id' => 9,
            'user_id'               => 1,
            'body'                  => '<p>Hell yeah Bro Sauce!</p>
        <p><img src="https://media.giphy.com/media/j5QcmXoFWl4Q0/giphy.gif" alt="" width="366" height="229" /></p>',
            'created_at' => '2016-08-18 15:01:25',
            'updated_at' => '2016-08-18 15:01:25',
        ],
        ]);
    }
}
