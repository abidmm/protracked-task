<?php

use App\Http\Controllers\PolicyController;
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

Route::get('/', [PolicyController::class, 'importView'])->name('import');
Route::get('/policy-list', [PolicyController::class, 'index'])->name('policies.index');


Route::post('/import', [PolicyController::class, 'import'])->name('policies.import');
