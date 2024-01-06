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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('jk')->length(10)->default('Laki-Laki');
            $table->string('alamat')->length(200)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('no_hp')->length(15)->nullable();
            $table->string('foto')->lengt(400)->nullable();
            $table->tinyInteger('is_aktif')->length(1)->default('1');
            $table->integer('id_level')->length(2);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
