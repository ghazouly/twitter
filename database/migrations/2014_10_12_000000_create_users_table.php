<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            //this field limits username with 20 characters only.
            $table->string('username', 20)->unique();

            $table->string('email')->unique();
            $table->string('password');

            //this field contains latest folowers & following count that user has.
            $table->integer('followersCount')->nullable();
            $table->integer('followingCount')->nullable();
            $table->integer('tweetsCount')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
