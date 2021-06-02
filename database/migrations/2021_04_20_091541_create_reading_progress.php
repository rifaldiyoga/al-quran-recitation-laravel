<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadingProgress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reading_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('surah');
            $table->integer('surah_id');
            $table->integer('ayat');
            $table->string('ref_type'); //input grup atau user
            $table->integer('ref_id'); // id user atau grup
            $table->integer('group_id');// diisi jika reftype = grup untuk refrensi ke grup mana
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reading_progress');
    }
}
