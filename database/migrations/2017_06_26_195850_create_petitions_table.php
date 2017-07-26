<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('petitions')) {
            Schema::create('petitions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('type')->default('petition');

                $table->integer('author_id')->unsigned();
                $table->foreign('author_id')->references('id')->on('users');

                $table->integer('mailing_id')->unsigned()->nullable();
                $table->foreign('mailing_id')->references('id')->on('mailing_adresses');

                $table->text('image_path');
                $table->string('title');
                $table->string('total_signatures');
                $table->text('text');
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('categories_petitions')) {
            Schema::create('categories_petitions', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('categories_id');
                $table->integer('petitions_id');
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
        Schema::dropIfExists('petitions');
        Schema::dropIfexists('categories_petitions');
    }
}
