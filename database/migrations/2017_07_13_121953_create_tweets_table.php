<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->increments('id');

            //this field represents the user whom posted this tweet.
            $table->integer('ownerUserId')->unsigned();
            $table->foreign('ownerUserId')->references('id')->on('users');

            //this field limits the tweet characters to 140 only as in twitter.
            $table->string('content', 140);

            //this field contains latest likes count that tweet has.
            $table->integer('likesCount')->nullable();

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
        Schema::dropIfExists('tweets');
    }
}
