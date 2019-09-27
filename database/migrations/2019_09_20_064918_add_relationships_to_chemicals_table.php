<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToChemicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('chemicals', function (Blueprint $table) {
          $table->integer('tocsin_id')->unsigned()->change();
          $table->foreign('tocsin_id')->references('id')->on('tocsins')
                  ->onUpdate('cascade')->onDelete('cascade');

          $table->integer('material_id')->unsigned()->change();
          $table->foreign('material_id')->references('id')->on('materials')
                    ->onUpdate('cascade')->onDelete('cascade');

          $table->integer('package_id')->unsigned()->change();
          $table->foreign('package_id')->references('id')->on('packages')
                      ->onUpdate('cascade')->onDelete('cascade');

          $table->integer('unit_id')->unsigned()->change();
          $table->foreign('unit_id')->references('id')->on('units')
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
        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropForeign('chemicals_tocsin_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropIndex('chemicals_tocsin_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->integer('tocsin_id')->change();
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropForeign('chemicals_material_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropIndex('chemicals_material_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->integer('material_id')->change();
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropForeign('chemicals_package_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropIndex('chemicals_package_id_foreign');
        });
        Schema::table('chemicals', function(Blueprint $table) {
            $table->integer('package_id')->change();
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropForeign('chemicals_unit_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->dropIndex('chemicals_unit_id_foreign');
        });

        Schema::table('chemicals', function(Blueprint $table) {
            $table->integer('unit_id')->change();
        });
    }
}
