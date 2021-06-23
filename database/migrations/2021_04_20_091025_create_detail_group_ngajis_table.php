<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailGroupNgajisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_group_ngajis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('group_ngaji_id');
            $table->integer('user_id');
            $table->date('joined_at');
            $table->string('role_type');
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
        Schema::dropIfExists('detail_group_ngajis');
    }
}
