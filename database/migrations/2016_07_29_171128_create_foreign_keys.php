<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table('forum_discussion', function (Blueprint $table) {
            $table->foreign('forum_category_id')->references('id')->on('forum_categories')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
        Schema::table('forum_post', function (Blueprint $table) {
            $table->foreign('forum_discussion_id')->references('id')->on('forum_discussion')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('forum_discussion', function (Blueprint $table) {
            $table->dropForeign('forum_discussion_forum_category_id_foreign');
            $table->dropForeign('forum_discussion_user_id_foreign');
        });
        Schema::table('forum_post', function (Blueprint $table) {
            $table->dropForeign('forum_post_forum_discussion_id_foreign');
            $table->dropForeign('forum_post_user_id_foreign');
        });
    }
}
