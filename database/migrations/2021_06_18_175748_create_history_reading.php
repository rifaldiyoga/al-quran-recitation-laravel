<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryReading extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recitation_progres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('first_surah_id');
            $table->string('first_surah');
            $table->integer('first_ayat');
            $table->integer('last_surah_id');
            $table->string('last_surah');
            $table->integer('last_ayat');
            $table->integer('group_ngaji_id');
            $table->integer('mentor_id');
            $table->string('status');
            $table->integer('checked_by')->nullable();
            $table->dateTime('checked_date')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('history_reading');
    }
}
