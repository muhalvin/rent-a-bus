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
        Schema::create('bus', function (Blueprint $table) {
            $table->id();
            $table->string('bus')->nullable();
            $table->integer('id_merek');
            $table->integer('id_tipe');
            $table->string('harga_sewa')->default(0);
            $table->integer('kapasitas')->default(1);
            $table->year('tahun_bus')->nullable();
            $table->string('no_rangka')->nullable();
            $table->string('no_mesin')->nullable();
            $table->string('no_plat')->nullable();
            $table->year('tahun_operasi')->nullable();
            $table->string('mileage')->nullable();
            $table->string('transmission')->default('Manual');
            $table->string('luggage')->default('32 Bags');
            $table->string('fuel')->default('Solar');
            $table->text('fitur')->nullable();
            $table->text('deskripsi')->nullable();
            $table->tinyInteger('is_aktif')->default(1);
            $table->string('gambar')->nullable();
            $table->integer('created_by')->index();
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
        Schema::dropIfExists('bus');
    }
};
