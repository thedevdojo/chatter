<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumPostTable extends Migration
{
    public function up()
    {
        Schema::create('forum_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('forum_discussion_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('forum_post');
    }
}
