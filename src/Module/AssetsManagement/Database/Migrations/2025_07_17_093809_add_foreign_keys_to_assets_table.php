<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('assets')) 
        {
        Schema::table('assets', function (Blueprint $table) {
            $table->foreign(['asset_type_id'], 'assets_ibfk_1')->references(['id'])->on('asset_types');
            $table->foreign(['location_id'], 'assets_ibfk_3')->references(['id'])->on('locations');
            $table->foreign(['vendor_id'], 'assets_ibfk_2')->references(['id'])->on('vendors');
        });
                }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropForeign('assets_ibfk_1');
            $table->dropForeign('assets_ibfk_3');
            $table->dropForeign('assets_ibfk_2');
        });
    }
}
