<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

# assets management system
use Modules\AssetsManagement\Http\Controllers\Asset_TypesController;
use Modules\AssetsManagement\Http\Controllers\Asset_AssignmentsController;
use Modules\AssetsManagement\Http\Controllers\Asset_DisposalsController;
use Modules\AssetsManagement\Http\Controllers\Asset_MaintenanceController;
use Modules\AssetsManagement\Http\Controllers\Asset_ReturnsController;
use Modules\AssetsManagement\Http\Controllers\AssetsController;
use Modules\AssetsManagement\Http\Controllers\EmployeesController;
use Modules\AssetsManagement\Http\Controllers\VendorsController;
use Modules\AssetsManagement\Http\Controllers\AutoVouchingAssetsManagementController;

Route::prefix('assetsmanagement')->group(function() 
{
    Route::get('/', 'AssetsManagementController@index');

    # assets management system

    Route::group(['prefix'=>'asset_types/','as'=>'asset_types.'], function()
   {
      Route::get('listing', [Asset_TypesController::class, 'index'])->name('listing');
      Route::get('adding', [Asset_TypesController::class, 'create'])->name('adding');
      Route::post('saving', [Asset_TypesController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [Asset_TypesController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [Asset_TypesController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [Asset_TypesController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [Asset_TypesController::class, 'destroy'])->name('deleting');

      Route::get('importing', [Asset_TypesController::class, 'importing'])->name('importing');
      Route::post('importing', [Asset_TypesController::class, 'importing'])->name('importing');
   });

   Route::group(['prefix'=>'asset_assignments/','as'=>'asset_assignments.'], function()
   {
      Route::get('listing', [Asset_AssignmentsController::class, 'index'])->name('listing');
      Route::get('adding', [Asset_AssignmentsController::class, 'create'])->name('adding');
      Route::post('saving', [Asset_AssignmentsController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [Asset_AssignmentsController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [Asset_AssignmentsController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [Asset_AssignmentsController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [Asset_AssignmentsController::class, 'destroy'])->name('deleting');
   });


   Route::group(['prefix'=>'asset_disposals/','as'=>'asset_disposals.'], function()
   {
      Route::get('listing', [Asset_DisposalsController::class, 'index'])->name('listing');
      Route::get('adding', [Asset_DisposalsController::class, 'create'])->name('adding');
      Route::post('saving', [Asset_DisposalsController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [Asset_DisposalsController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [Asset_DisposalsController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [Asset_DisposalsController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [Asset_DisposalsController::class, 'destroy'])->name('deleting');
   });

   Route::group(['prefix'=>'asset_maintenance/','as'=>'asset_maintenance.'], function()
   {
      Route::get('listing', [Asset_MaintenanceController::class, 'index'])->name('listing');
      Route::get('adding', [Asset_MaintenanceController::class, 'create'])->name('adding');
      Route::post('saving', [Asset_MaintenanceController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [Asset_MaintenanceController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [Asset_MaintenanceController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [Asset_MaintenanceController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [Asset_MaintenanceController::class, 'destroy'])->name('deleting');
   });

   Route::group(['prefix'=>'asset_returns/','as'=>'asset_returns.'], function()
   {
      Route::get('listing', [Asset_ReturnsController::class, 'index'])->name('listing');
      Route::get('adding', [Asset_ReturnsController::class, 'create'])->name('adding');
      Route::post('saving', [Asset_ReturnsController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [Asset_ReturnsController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [Asset_ReturnsController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [Asset_ReturnsController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [Asset_ReturnsController::class, 'destroy'])->name('deleting');
   });

   
   Route::group(['prefix'=>'assets/','as'=>'assets.'], function()
   {
      Route::get('listing', [AssetsController::class, 'index'])->name('listing');
      Route::get('adding', [AssetsController::class, 'create'])->name('adding');
      Route::post('saving', [AssetsController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [AssetsController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [AssetsController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [AssetsController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [AssetsController::class, 'destroy'])->name('deleting');
   });

   Route::group(['prefix'=>'employees/','as'=>'employees.'], function()
   {
      Route::get('listing', [EmployeesController::class, 'index'])->name('listing');
      Route::get('adding', [EmployeesController::class, 'create'])->name('adding');
      Route::post('saving', [EmployeesController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [EmployeesController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [EmployeesController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [EmployeesController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [EmployeesController::class, 'destroy'])->name('deleting');
   });

   Route::group(['prefix'=>'vendors/','as'=>'vendors.'], function()
   {
      Route::get('listing', [VendorsController::class, 'index'])->name('listing');
      Route::get('adding', [VendorsController::class, 'create'])->name('adding');
      Route::post('saving', [VendorsController::class, 'store'])->name('saving');

      Route::get('editing/{id}', [VendorsController::class, 'edit'])->name('editing');
      Route::get('showing/{id}', [VendorsController::class, 'show'])->name('showing');
      Route::post('updating/{id}', [VendorsController::class, 'update'])->name('updating');

      Route::get('deleting/{id}', [VendorsController::class, 'destroy'])->name('deleting');
   });


   Route::prefix('AutoVouchingAssetsManagement')->name('AutoVouchingAssetsManagement.')->group(function () 
      {
        Route::get('listing', [AutoVouchingAssetsManagementController::class, 'index'])->name('listing');
        Route::get('edit/{id}', [AutoVouchingAssetsManagementController::class, 'edit'])->name('edit');
        Route::post('update/{id}', [AutoVouchingAssetsManagementController::class, 'update'])->name('update');
    });

});
