<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_follows', function (Blueprint $table) {
            $table->increments('id');

            //this field represents the user whom is going to follow someone in the next field.
            $table->integer('followerId')->unsigned();
            $table->foreign('followerId')->references('id')->on('users');

            //this field represents the user whom is followed by someone in the previous field.
            $table->integer('followedId')->unsigned();
            $table->foreign('followedId')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_follows');
    }
}
