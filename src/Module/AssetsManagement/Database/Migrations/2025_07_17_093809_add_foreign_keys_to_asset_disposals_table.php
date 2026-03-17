<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetDisposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('asset_disposals')) 
        {
        Schema::table('asset_disposals', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'asset_disposals_ibfk_1')->references(['id'])->on('assets');
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
        Schema::table('asset_disposals', function (Blueprint $table) {
            $table->dropForeign('asset_disposals_ibfk_1');
        });
    }
}
