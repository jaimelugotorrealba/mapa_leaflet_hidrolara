<?php

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
route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function(){
    route::get('/',function(){
        return view('admin.index');
    })->name('admin.index');
    Route::get('/operability', [OperabilityController::class, 'index'])->middleware('auth')->name('operability.index');
    Route::get('/operability/create', [OperabilityController::class, 'create'])->middleware('auth')->name('operability.create');
    Route::post('/operability/create', [OperabilityController::class, 'store'])->middleware('auth')->name('operability.store');
    Route::get('/operability/create/{operability}',[OperabilityController::class, 'edit'])->middleware('auth')->name('operability.edit');
    Route::post('/operability/create/{operability}',[OperabilityController::class, 'update'])->middleware('auth')->name('operability.update');
    Route::post('/operability/delete/{operability}',[OperabilityController::class, 'destroy'])->middleware('auth')->name('operability.delete');
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

Route::get('administrator', AdministratorComponent::class)->middleware('administrator')->name('administrator.index');
