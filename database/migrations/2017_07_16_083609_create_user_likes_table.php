<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_likes', function (Blueprint $table) {
            $table->increments('id');

            //this field represents the user whom is going to follow someone in the next field.
            $table->integer('tweetId')->unsigned();
            $table->foreign('tweetId')->references('id')->on('tweets');

            //this field represents the user whom is followed by someone in the previous field.
            $table->integer('likerId')->unsigned();
            $table->foreign('likerId')->references('id')->on('users');

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
        Schema::dropIfExists('user_likes');
    }
}
