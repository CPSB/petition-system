<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('signatures')) {
            Schema::create('signatures', function (Blueprint $table) {
                $table->increments('id');
                $table->string('publish')->default('Y');
                $table->integer('country_id');
                $table->integer('postal_code');
                $table->string('city');
                $table->string('name');
                $table->string('email');
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
        Schema::dropIfExists('signatures');
    }
}
