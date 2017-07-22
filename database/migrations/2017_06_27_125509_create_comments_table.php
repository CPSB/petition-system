<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       if (! Schema::hasTable('comments')) {
           Schema::create('comments', function (Blueprint $table) {
                $table->increments('id');
               
                $table->integer('author_id')->unsigned();
                $table->foreign('author_id')->references('id')->on('users');

                $table->text('comment');
                $table->timestamps();
           });
       }

       if (! Schema::hasTable('comments_helpdesk')) {
           Schema::create('comments_helpdesk', function (Blueprint $table) {
               $table->increments('id');
               
               $table->integer('helpdesk_id')->unsigned();
               $table->foreign('helpdesk_id')->references('id')->on('helpdesks');

               $table->integer('comments_id')->unsigned();
               $table->foreign('comments_id')->references('id')->on('comments');
               
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
        Schema::dropIfExists('comments');
        Schema::dropIfexists('comments_helpdesk');
    }
}
