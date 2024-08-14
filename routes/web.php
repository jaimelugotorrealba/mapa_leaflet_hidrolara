<?php

use App\Http\Controllers\MapController;
use App\Livewire\AdministratorComponent;
use App\Livewire\MapComponent;
use App\Livewire\UbicationCreate;
use Illuminate\Support\Facades\Route;

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
Livewire::setScriptRoute(function ($handle) {
    return Route::get('/scsg/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/scsg/livewire/update', $handle);
});
Route::get('/register', function(){
    return redirect('login');
});
Route::get('/', MapComponent::class)->middleware('auth')->name('dashboard');
Route::get('/create', [MapController::class, 'index'])->middleware('auth')->name('map.create');
Route::post('/create', [MapController::class, 'store'])->middleware('auth')->name('map.store');
Route::get('/create/{operability}',[MapController::class, 'edit'])->middleware('auth')->name('map.edit');
Route::post('/create/{operability}',[MapController::class, 'update'])->middleware('auth')->name('map.update');
Route::get('administrator', AdministratorComponent::class)->middleware('administrator')->name('administrator.index');
