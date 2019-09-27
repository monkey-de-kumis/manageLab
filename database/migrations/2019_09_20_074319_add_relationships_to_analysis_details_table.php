<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToAnalysisDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('analysis_details', function (Blueprint $table) {
            $table->integer('analysis_id')->unsigned()->change();
            $table->foreign('analysis_id')->references('id')->on('analyses')
                  ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::table('analysis_details', function (Blueprint $table) {
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
        Schema::table('analysis_details', function(Blueprint $table) {
             $table->dropForeign('analysis_details_analysis_id_foreign');
         });

         Schema::table('analysis_details', function(Blueprint $table) {
             $table->dropIndex('analysis_details_analysis_id_foreign');
         });

         Schema::table('analysis_details', function(Blueprint $table) {
             $table->integer('analysis_id')->change();
         });

         Schema::table('analysis_details', function(Blueprint $table) {
              $table->dropForeign('analysis_details_chemical_id_foreign');
          });

          Schema::table('analysis_details', function(Blueprint $table) {
              $table->dropIndex('analysis_details_chemical_id_foreign');
          });

          Schema::table('analysis_details', function(Blueprint $table) {
              $table->integer('chemical_id')->change();
          });
    }
}
