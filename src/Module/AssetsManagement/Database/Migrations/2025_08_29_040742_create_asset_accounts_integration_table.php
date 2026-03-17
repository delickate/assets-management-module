<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetAccountsIntegrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('asset_accounts_integration')) 
        {
        Schema::create('asset_accounts_integration', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('module_name', 100);
            $table->enum('action_type', ['add', 'update', 'delete'])->default('add');
            $table->integer('debit_account_id');
            $table->integer('credit_account_id');
            $table->string('description', 255)->nullable();
            $table->boolean('is_active')->nullable()->default(true);
            $table->dateTime('created_at')->nullable()->useCurrent();
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
        Schema::dropIfExists('asset_accounts_integration');
    }
}
