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
            $table->string('jml_kata')->after('dibaca')->change();
            $table->integer('dibaca')->default(0)->change();
            $table->bigInteger('updated_by')->nullable()->change();
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
            
        });
    }
};
