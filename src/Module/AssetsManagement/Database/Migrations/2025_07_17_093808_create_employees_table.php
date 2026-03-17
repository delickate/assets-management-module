<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('employees')) 
        {
        Schema::create('employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';  
            $table->integer('id', true); 
           $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email',150)->unique()->nullable();
            $table->string('phone',50)->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->date('joining_date')->nullable();
            $table->enum('status', ['active', 'resigned', 'terminated'])->default('active');
             $table->softDeletes(); 
            // $table->string('email', 150)->nullable();
            // $table->string('phone', 50)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
