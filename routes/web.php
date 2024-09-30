<?php

use App\Http\Controllers\BinnacleController;
use App\Livewire\MapComponent;
use App\Livewire\UbicationCreate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MapController;
use App\Livewire\AdministratorComponent;
use App\Http\Controllers\OperabilityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
route::group(['middleware' => ['auth','permission'], 'prefix' => 'admin'], function(){
    route::get('/',function(){
        return view('admin.index');
    })->name('admin.index');
    //operability
        Route::get('/operability', [OperabilityController::class, 'index'])->middleware('auth')->name('operability.index');
        Route::get('/operability/create', [OperabilityController::class, 'create'])->middleware('auth')->name('operability.create');
        Route::post('/operability/create', [OperabilityController::class, 'store'])->middleware('auth')->name('operability.store');
        Route::get('/operability/create/{operability}',[OperabilityController::class, 'edit'])->middleware('administrator')->name('operability.edit');
        Route::post('/operability/create/{operability}',[OperabilityController::class, 'update'])->middleware('administrator')->name('operability.update');
        Route::post('/operability/delete/{operability}',[OperabilityController::class, 'destroy'])->middleware('administrator')->name('operability.delete');

    Route::get('administrator', function(){
        return view('admin.users.index');
    })->middleware('administrator')->name('administrator.index');

    Route::get('binnacles',[BinnacleController::class,'index'])->name('binnacles.index');
    Route::get('binnacles/{operability}',[BinnacleController::class,'edit'])->name('binnacles.edit');
    Route::put('binnacles/{operability}',[BinnacleController::class,'update'])->name('binnacles.update');

});
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/scsg/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/scsg/livewire/update', $handle);
});
Route::get('/register', function(){
    return redirect('login');
});
Route::get('welcome',function(){
    return view('welcome');
});
Route::get('/', MapComponent::class)->middleware('auth')->name('dashboard');


