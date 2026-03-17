<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
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
        Schema::create('assets', function (Blueprint $table) {
            $table->engine = 'InnoDB';   
            $table->integer('id', true);
            $table->string('asset_tag', 50)->unique('asset_tag');
            $table->string('asset_name', 150);
            $table->integer('asset_type_id')->nullable()->index('asset_type_id');
            $table->string('brand', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('serial_number', 100)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('purchase_cost', 12)->nullable();
            $table->integer('vendor_id')->nullable()->index('vendor_id');
            $table->integer('location_id')->nullable()->index('location_id');
            $table->date('warranty_expiry_date')->nullable();
            $table->enum('status', ['available', 'assigned', 'maintenance', 'disposed'])->nullable()->default('available');
            $table->text('remarks')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
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
        Schema::dropIfExists('assets');
    }
}
