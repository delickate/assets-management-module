<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('vendors')) 
        {
        Schema::create('vendors', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->integer('id', true);  
            $table->string('name', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('contact_info')->nullable();
            $table->unsignedInteger('account_id')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('office_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();
            $table->unsignedInteger('division_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('tehsil_id')->nullable();
            $table->unsignedInteger('uc_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
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
        Schema::dropIfExists('vendors');
    }
}
