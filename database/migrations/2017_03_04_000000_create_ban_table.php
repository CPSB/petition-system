<?php

/*
 * This file is part of Laravel Ban.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateBanTable.
 */
class CreateBanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('ban')) {
            Schema::create('ban', function (Blueprint $table) {
                $table->increments('id');
                $table->morphs('owned_by');
                $table->nullableMorphs('created_by');
                $table->text('comment')->nullable();
                $table->timestamp('expired_at')->nullable();
                $table->softDeletes();
                $table->timestamps();

                $table->index('expired_at');
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
        Schema::dropIfExists('ban');
    }
}
