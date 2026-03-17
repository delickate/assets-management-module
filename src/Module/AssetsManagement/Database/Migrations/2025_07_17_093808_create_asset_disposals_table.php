<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDisposalsTable extends Migration
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
        Schema::create('asset_disposals', function (Blueprint $table) {
            $table->engine = 'InnoDB';   
            $table->integer('id', true);
            $table->integer('asset_id')->index('asset_id');
            $table->date('disposal_date');
            $table->text('reason')->nullable();
            $table->decimal('scrap_value', 10)->nullable();
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
        Schema::dropIfExists('asset_disposals');
    }
}
