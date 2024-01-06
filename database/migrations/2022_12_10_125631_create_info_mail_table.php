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
        Schema::create('info_mail', function (Blueprint $table) {
            $table->char('protocol')->length(10)->default('smtp')->nullable();
            $table->string('smtp_host')->length(100)->default('ssl://smtp.googlemail.com')->nullable();
            $table->char('smtp_port')->length(5)->default('465')->nullable();
            $table->string('smtp_user')->length(150)->default('yourmail@mail.com')->nullable();
            $table->string('smtp_pass')->length(150)->default('yourpassword')->nullable();
            $table->char('charset')->length(10)->default('iso-8859-1')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_mail');
    }
};
