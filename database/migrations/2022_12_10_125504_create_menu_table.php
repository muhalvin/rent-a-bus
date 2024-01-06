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
        Schema::create('menu', function (Blueprint $table) {
            $table->integer('id')->length(3)->autoIncrement();
            $table->string('menu')->length(100);
            $table->string('lang_text')->length(100)->nullable();
            $table->integer('icon_id')->length(11)->nullable();
            $table->tinyInteger('is_link')->default(0);
            $table->string('link')->nullable();
            $table->tinyInteger('is_separator')->default(0);
            $table->string('separator_text')->length(30)->nullable();
            $table->string('urutan')->length(4)->default('100');
            $table->integer('parent_id')->length(11)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu');
    }
};
