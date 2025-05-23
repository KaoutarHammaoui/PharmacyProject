<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pharmacycontroller;

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
    return view('welcome');
});
Route::get('login',function(){
    return view('loginInterface');
});
Route::post('login',[pharmacycontroller::class,'login'])->name('login');
Route::get('/admin/dashboard', [pharmacycontroller::class, 'indexadmin'])->name('admin.dashboard');
Route::get('/pharmacist/dashboard', [pharmacycontroller::class, 'indexpharmacist'])->name('pharmacist.dashboard');
Route::get('/hash', function () {
    return bcrypt('kaoutar');
});
