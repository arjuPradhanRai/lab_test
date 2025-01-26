<?php

use App\Http\Controllers\DepTestController;
use App\Http\Controllers\LabTestController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[LabTestController::class,'index'])->name('index');
Route::post('/filter',[LabTestController::class,'filterTest'])->name('filter');
Route::post('/store-test',[LabTestController::class,'storeTest'])->name('store.test');

Route::get('testindex',[DepTestController::class,'testindex'])->name('test.index');
Route::post('/store-dep',[DepTestController::class,'storeDep'])->name('store.dep');
Route::post('/delete-dep',[DepTestController::class,'deleteDep'])->name('delete-dep');

Route::post('/edit-test',[LabTestController::class,'editTest'])->name('edit-test');
Route::post('/update-test',[LabTestController::class,'updateTest'])->name('update.test');
Route::post('/edit-lab',[LabTestController::class,'editLab'])->name('edit-lab');
