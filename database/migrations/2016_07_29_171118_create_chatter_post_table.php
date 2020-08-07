<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatterPostTable extends Migration
{
    public function up()
    {
        Schema::create('chatter_post', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('chatter_discussion_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('body');
            $table->timestamps();


            $table->foreign('chatter_discussion_id')
                ->references('id')
                ->on('chatter_discussion')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::drop('chatter_post');
    }
}
