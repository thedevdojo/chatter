<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('forum_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('order')->default(1);
            $table->string('name');
            $table->string('color', 20);
            $table->string('slug');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('forum_categories');
    }
}
