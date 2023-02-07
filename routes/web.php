<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[EmailController::class,'index'])->name('email.index');
Route::get('/create',[EmailController::class,'create'])->name('email.create');
Route::post('/store',[EmailController::class,'store'])->name('email.store');
Route::post('/send',[EmailController::class,'send'])->name('email.send');
Route::post('/delete/{id}',[EmailController::class,'delete'])->name('email.delete');

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
