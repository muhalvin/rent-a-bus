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
        Schema::table('hak_akses', function(Blueprint $table){
            $table->index('level_id')->change();
            $table->text('menu_id')->after('level_id')->change();
            $table->text('menu_detail_id')->after('menu_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hak_akses', function(Blueprint $table){
            $table->dropIndex('level_id')->change();
        });
    }
};
