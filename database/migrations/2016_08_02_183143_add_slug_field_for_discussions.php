<?php

use DevDojo\Chatter\Helpers\ChatterHelper;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugFieldForDiscussions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(ChatterHelper::tableName('discussion'), function (Blueprint $table) {
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(ChatterHelper::tableName('discussion'), function ($table) {
            $table->dropColumn('slug');
        });
    }
}
