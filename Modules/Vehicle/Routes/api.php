<?php
use Modules\Vehicle\Http\Controllers\ApiController;
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
Route::post('vehicle/order', [ApiController::class, 'Order']);
Route::post('vehicle/enquiry', [ApiController::class, 'Enquiry']);
Route::post('vehicle/years', [ApiController::class, 'YearsList']);
Route::post('vehicle/vechile-model', [ApiController::class, 'VechileModel']);
Route::post('vehicle/vechile-make', [ApiController::class, 'VechileMake']);
Route::post('vehicle/fuel-type', [ApiController::class, 'FuelTypes']);
Route::post('vehicle/exterior-colors', [ApiController::class, 'ExteriorColors']);
Route::post('vehicle/vechile-name', [ApiController::class, 'VechileNames']);
Route::post('vehicle/interior-types', [ApiController::class, 'InteriorTypes']);
Route::post('vehicle/interior-colors', [ApiController::class, 'InteriorColors']);
Route::post('vehicle/engines', [ApiController::class, 'Engines']);
Route::post('vehicle/transmissions', [ApiController::class, 'Transmissions']);
Route::post('vehicle/search', [ApiController::class, 'searchVehicle']);
Route::post('vehicle/details', [ApiController::class, 'VehicleDetails']);
Route::resource('vehicle', ApiController::class,['names' => 'vehicle']);



