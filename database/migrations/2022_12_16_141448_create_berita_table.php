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
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id')->autoIncrement();
            $table->string('judul')->length(150);
            $table->text('gambar')->nullable();
            $table->longText('isi');
            $table->string('permalink')->length(200);
            $table->integer('dibaca')->length(7);
            $table->date('tanggal')->nullable();
            $table->tinyInteger('is_publish')->length(1)->default(1);
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
        Schema::dropIfExists('berita');
    }
};
