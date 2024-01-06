<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->integer('menu_id')->length(11)->change();
            $table->integer('menu_detail_id')->length(11)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->text('menu_id')->change();
            $table->text('menu_detail_id')->change();
        });
    }
};
