<?php

use DevDojo\Chatter\Helpers\ChatterHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration
{
    public function up()
    {
        Schema::table(ChatterHelper::tableName('discussion'), function (Blueprint $table) {
            $table->foreign('chatter_category_id')->references('id')->on(ChatterHelper::tableName('categories'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table(ChatterHelper::tableName('post'), function (Blueprint $table) {
            $table->foreign('chatter_discussion_id')->references('id')->on(ChatterHelper::tableName('discussion'))
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table(ChatterHelper::tableName('discussion'), function (Blueprint $table) {
            $table->dropForeign('chatter_discussion_chatter_category_id_foreign');
            $table->dropForeign('chatter_discussion_user_id_foreign');
        });
        Schema::table(ChatterHelper::tableName('post'), function (Blueprint $table) {
            $table->dropForeign('chatter_post_chatter_discussion_id_foreign');
            $table->dropForeign('chatter_post_user_id_foreign');
        });
    }
}
