<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupNgajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_ngajis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group_name');
            $table->longText('group_desc');
            $table->string('img_src');
            $table->string('slug');
            $table->integer('created_by');
            $table->string('group_type');
            $table->softDeletes();
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
        Schema::dropIfExists('group_ngajis');
    }
}
