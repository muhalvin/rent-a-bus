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
        Schema::table('berita', function(Blueprint $table){
            $table->bigInteger('kategori_berita_id')->after('is_publish')->length(20);
            $table->bigInteger('created_by')->after('created_at')->length(20);
            $table->bigInteger('updated_by')->after('updated_at')->length(20);
            $table->index(['kategori_berita_id', 'created_by', 'updated_by']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('berita', function(Blueprint $table){
            $table->dropColumn('kategori_berita_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
