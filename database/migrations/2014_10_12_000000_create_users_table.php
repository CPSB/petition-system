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
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('country_id');
                $table->bigInteger('twitter_id')->default(0);
                $table->bigInteger('facebook_id')->nullable()->default(0);
                $table->string('first_name');
                $table->string('last_name');
                $table->string('postal_code');
                $table->string('city');
                $table->string('name')->nullable();
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->softDeletes();
                $table->timestamps();
            });
        }
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
