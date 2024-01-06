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
        Schema::table('hak_akses', function (Blueprint $table) {
            $table->text('menu_id')->after('id_level')->nullable()->change();
            $table->text('menu_detail_id')->after('menu_id')->nullable()->change();
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
            $table->text('menu_id')->after('id_level')->nullable()->change();
            $table->text('menu_detail_id')->after('menu_id')->nullable()->change();
        });
    }
};
