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
                
                $table->integer('category_id')->unsigned();
                $table->foreign('category_id')->references('id')->on('categories');        
        
                $table->integer('author_id')->unsigned();
                $table->foreign('author_id')->references('id')->on('users');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('helpdesks');
    }
}
