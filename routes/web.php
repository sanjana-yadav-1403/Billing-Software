<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AppController;
use App\Http\Controllers\GstBillController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [AppController::class,"index"]);
Route::get('/add-party',[PartyController::class,"addParty"])->name('add-party');
Route::post('/create-party',[PartyController::class,"createParty"])->name('create-party');
Route::get('/manage-parties',[PartyController::class,"index"])->name('manage-parties');
Route::get('/edit-party/{id}',[PartyController::class,"editParty"])->name('edit-party');
Route::put('/update-party/{id}',[PartyController::class,"updateParty"])->name('update-party');
Route::delete('/delete-party/{party}',[PartyController::class,"deleteParty"])->name('delete-party');

Route::get('/add-gst-bill',[GstBillController::class,"addGstBill"])->name('add-gst-bill');
Route::get('/manage-gst-bill',[GstBillController::class,"index"])->name('manage-gst-bill');
Route::get('/print-gst-bill/{id}',[GstBillController::class,"print"])->name('print-gst-bill');
Route::post('/create-gst-bill',[GstBillController::class,"createGstBill"])->name('create-gst-bill');

Route::get('/delete/{table}/{id}', [AppController::class,"delete"])->name('delete');
Auth::routes();

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);