<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('stocks', function (Blueprint $table) {
            $table->integer('chemical_id')->unsigned()->change();
            $table->foreign('chemical_id')->references('id')->on('chemicals')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('stocks', function(Blueprint $table) {
             $table->dropForeign('stocks_chemical_id_foreign');
         });

         Schema::table('stocks', function(Blueprint $table) {
             $table->dropIndex('stocks_chemical_id_foreign');
         });

         Schema::table('stocks', function(Blueprint $table) {
             $table->integer('chemical_id')->change();
         });
    }
}
