<?php

use DevDojo\Chatter\Helpers\ChatterHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChatterUserDiscussionPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(ChatterHelper::tableName('user_discussion'), function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('discussion_id')->unsigned()->index();
            $table->foreign('discussion_id')->references('id')->on(ChatterHelper::tableName('discussion'))->onDelete('cascade');
            $table->primary(['user_id', 'discussion_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(ChatterHelper::tableName('user_discussion'));
    }
}
