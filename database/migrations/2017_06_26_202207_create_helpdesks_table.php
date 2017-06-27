<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHelpdesksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('helpdesks')) {
            Schema::create('helpdesks', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('category_id')->nullable();
                $table->integer('author_id')->nullable();
                $table->string('open')->nullable();
                $table->string('publish')->nullable();
                $table->string('title')->nullable();
                $table->text('description')->nullable();
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
        Schema::dropIfExists('helpdesks');
    }
}
