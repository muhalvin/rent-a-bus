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
            $table->text('menu_detail_id')->nullable()->after('menu_id');
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
            $table->dropColumn('menu_detail_id');
        });
    }
};
