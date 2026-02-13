<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRoleController;

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

Route::get('/debug-test', function() {
    return "Le rotte funzionano!";
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:founder'])->group(function (){
    //Pagina di con tutti gli utenti e select dei ruoli
    Route::get('/founder/manage-user-role/search', 'App\Http\Controllers\UserRoleController@search')->name('founder.manage.user.search');
    Route::get('/founder/manage-user-role','App\Http\Controllers\UserRoleController@index')->name('founder.manage.user');
    Route::patch('/founder/manage-user-role/update-all','App\Http\Controllers\UserRoleController@updateAll')->name('founder.manage.users.updateAll');
});
require __DIR__.'/auth.php';
