<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('asset_maintenance')) 
        {
        Schema::table('asset_maintenance', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'asset_maintenance_ibfk_1')->references(['id'])->on('assets');
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
        Schema::table('asset_maintenance', function (Blueprint $table) {
            $table->dropForeign('asset_maintenance_ibfk_1');
        });
    }
}
