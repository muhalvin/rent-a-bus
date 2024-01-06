<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hak_akses', function (Blueprint $table) {
            $table->integer('id')->length(3)->autoIncrement();
            $table->integer('level_id')->length(2);
            $table->text('menu_id')->length(3)->nullable();
            $table->tinyInteger('tambah')->nullable();
            $table->tinyInteger('ubah')->nullable();
            $table->tinyInteger('hapus')->nullable();
            $table->tinyInteger('lihat')->nullable();
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
        Schema::dropIfExists('hak_akses');
    }
};
