<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToAnalysesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('analyses', function (Blueprint $table) {
            $table->integer('activity_id')->unsigned()->change();
            $table->foreign('activity_id')->references('id')->on('activities')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('analyses', function (Blueprint $table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::table('analyses', function(Blueprint $table) {
             $table->dropForeign('analyses_activity_id_foreign');
         });

         Schema::table('analyses', function(Blueprint $table) {
             $table->dropIndex('analyses_activity_id_foreign');
         });

         Schema::table('analyses', function(Blueprint $table) {
             $table->integer('activity_id')->change();
         });

         Schema::table('analyses', function(Blueprint $table) {
              $table->dropForeign('analyses_user_id_foreign');
          });

          Schema::table('analyses', function(Blueprint $table) {
              $table->dropIndex('analyses_user_id_foreign');
          });

          Schema::table('analyses', function(Blueprint $table) {
              $table->integer('user_id')->change();
          });
    }
}
