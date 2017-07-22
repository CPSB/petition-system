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
                
                $table->integer('country_id')->unsigned();
                $table->foreign('country_id')->references('id')->on('countries');

                $table->integer('postal_code');
                $table->string('city');
                $table->string('name');
                $table->string('email');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('petitions_signatures')) {
            Schema::create('petitions_signatures', function (Blueprint $table) {
                $table->increments('id');

                $table->integer('petitions_id')->unsigned();
                $table->foreign('petitions_id')->references('id')->on('petitions');

                $table->integer('signatures_id')->unsigned();
                $table->foreign('signatures_id')->references('id')->on('signatures');
                
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('signatures');
        Schema::dropIfExists('petitions_signatures');
    }
}
