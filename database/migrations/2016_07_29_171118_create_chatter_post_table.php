<?php

use DevDojo\Chatter\Helpers\ChatterHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatterPostTable extends Migration
{
    public function up()
    {
        Schema::create(ChatterHelper::tableName('post'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chatter_discussion_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop(ChatterHelper::tableName('post'));
    }
}
