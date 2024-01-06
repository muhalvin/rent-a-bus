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
        Schema::create('info_sistem', function (Blueprint $table) {
            $table->string('title_header')->length(100)->default('CRUD Builder');
            $table->string('title_footer')->length(100)->default('PT. Digital Media Bangsa');
            $table->string('logo')->length(400)->nullable();
            $table->string('app_name')->length(100)->default('CRUD Builder Laravel');
            $table->text('deskripsi')->nullable();
            $table->string('email')->length(100)->default('yourmail@mail.com');
            $table->string('alamat')->length(150)->nullable();
            $table->string('no_telepon')->length(15)->nullable();
            $table->tinyInteger('website_status')->length(1)->default(1);
            $table->integer('id_bahasa')->length(4)->nullable();

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
        Schema::dropIfExists('info_sistem');
    }
};
