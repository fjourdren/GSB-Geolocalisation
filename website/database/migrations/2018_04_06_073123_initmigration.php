<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class initmigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('tel');
            $table->string('login')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('email');
            $table->string('password');
            $table->boolean('isadmin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('locations', function ($table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
        Schema::drop('locations');


        Schema::table('locations', function($table) {
           $table->dropForeign('locations_user_id_foreign');
        });
    }
}
