<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetMaintenanceTable extends Migration
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
        Schema::create('asset_maintenance', function (Blueprint $table) {
            $table->engine = 'InnoDB';   
            $table->integer('id', true);
            $table->integer('asset_id')->index('asset_id');
            $table->date('maintenance_date');
            $table->enum('type', ['repair', 'service']);
            $table->decimal('cost', 10)->nullable();
            $table->enum('status', ['in_progress', 'completed'])->nullable()->default('in_progress');
            $table->text('remarks')->nullable();
             $table->softDeletes(); 
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
        Schema::dropIfExists('asset_maintenance');
    }
}
