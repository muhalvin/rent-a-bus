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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->string('kd_pesanan');
            $table->integer('id_penyewa')->index();
            $table->integer('id_bus')->index();
            $table->date('tgl_pesan')->nullable();
            $table->date('tgl_mulai_sewa')->nullable();
            $table->date('tgl_selesai_sewa')->nullable();
            $table->string('waktu_pickup')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('total_biaya')->nullable();
            $table->enum('status', ['belum','dp','lunas'])->default('belum');
            $table->integer('created_by')->index()->nullable();
            $table->integer('updated_by')->index()->nullable();
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
        Schema::dropIfExists('pesanan');
    }
};
