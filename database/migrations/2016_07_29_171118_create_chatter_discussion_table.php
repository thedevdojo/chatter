<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatterDiscussionTable extends Migration
{
    public function up()
    {
        Schema::create('chatter_discussion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('chatter_category_id')->unsigned()->default('1');
            $table->string('title');
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('sticky')->default(false);
            $table->bigInteger('views')->unsigned()->default('0');
            $table->boolean('answered')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('chatter_discussion');
    }
}
