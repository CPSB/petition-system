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
                $table->integer('author_id');
                $table->string('title');
                $table->string('total_signatures');
                $table->text('text');
                $table->timestamps();
            });
        }    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petitions');
    }
}
