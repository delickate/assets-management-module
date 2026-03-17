<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAssetAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('asset_assignments')) 
        {
        Schema::table('asset_assignments', function (Blueprint $table) {
            $table->foreign(['asset_id'], 'asset_assignments_ibfk_1')->references(['id'])->on('assets');
            $table->foreign(['employee_id'], 'asset_assignments_ibfk_2')->references(['id'])->on('employees');
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
        Schema::table('asset_assignments', function (Blueprint $table) {
            $table->dropForeign('asset_assignments_ibfk_1');
            $table->dropForeign('asset_assignments_ibfk_2');
        });
    }
}
