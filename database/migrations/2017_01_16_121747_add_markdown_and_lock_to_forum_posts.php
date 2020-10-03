<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMarkdownAndLockToForumPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forum_post', function (Blueprint $table) {
            $table->boolean('markdown')->default(0);
            $table->boolean('locked')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forum_post', function ($table) {
            $table->dropColumn(['markdown', 'locked']);
        });
    }
}
