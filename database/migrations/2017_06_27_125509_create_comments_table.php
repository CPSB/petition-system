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
               $table->integer('author_id');
               $table->text('comment');
               $table->timestamps();
           });
       }

       if (! Schema::hasTable('comments_helpdesk')) {
           Schema::create('comments_helpdesk', function (Blueprint $table) {
               $table->increments('id');
               $table->integer('helpdesk_id');
               $table->integer('comments_id');
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
        Schema::dropIfExists('comments');
        Schema::dropIfexists('comments_helpdesk');
    }
}
