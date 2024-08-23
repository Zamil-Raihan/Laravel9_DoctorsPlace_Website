<?php

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\OrderController;
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



Route::get('/', function () {
    return view('index');
});

Route::get('/tips', function () {
    return view('tips');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/tips', function () {
    return view('tips');
});


Route::get('/doctors_list', [DoctorController::class,'index_public'])->name('doctors.index_public');


Route::get('/doctors_edit/{doctor}', [DoctorController::class,'edit'])->name('doctors.edit');
Route::put('/doctors/{doctor}', [DoctorController::class,'update'])->name('doctors.update');
Route::delete('/doctors/{doctor}', [DoctorController::class,'destroy'])->name('doctors.destroy');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'userHome'])->name('home');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/home_admin', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home');

    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors_create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
});

Route::get('/orders',[OrderController::class,'order_index'])->name('orders.order_index');
Route::get('/orders_create/{doctor_id}',[OrderController::class,'create'])->name('orders.create');
Route::post('/orders',[OrderController::class,'store'])->name('orders.store');
Route::delete('/orders/{order}', [OrderController::class,'destroy'])->name('orders.destroy');
