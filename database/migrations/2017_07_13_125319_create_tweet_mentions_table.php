<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTweetMentionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweet_mentions', function (Blueprint $table) {
            $table->increments('id');

            //this field represents the tweet which has a user metioned within it.
            $table->integer('tweetId')->unsigned();
            $table->foreign('tweetId')->references('id')->on('tweets');

            //this field represents the user whom is mentioned in this tweet.
            $table->integer('mentionedUserId')->unsigned();
            $table->foreign('mentionedUserId')->references('id')->on('users');

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
        Schema::dropIfExists('tweet_mentions');
    }
}
