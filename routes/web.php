<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pharmacycontroller;
use App\Http\Controllers\pharmacistController;

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

Route::get('/addUser',function(){
    return view('admin.addUser');
})->name('addUserView');
Route::post('/insertUser',[pharmacycontroller::class,'addUser'])->name('addUser');
Route::get('/usersinfos', [pharmacycontroller::class,'getUsers'])->name('usersInfos');

Route::post('/logOut',[pharmacycontroller::class,'logOut'])->name('logOut');
//sales
Route::get('/salesReport',function(){
    return view('admin.salesReport');

})->name('salesReport');
Route::get('/reports', [pharmacycontroller::class, 'salesReport'])->name('reports');
Route::post('/insertSales',[pharmacycontroller::class,'sales'])->name('insertsales');

//backup

Route::get('/backup', [pharmacycontroller::class, 'backupDeletedUsers'])->name('backUp');
Route::put('/restore-user/{id}', [pharmacycontroller::class, 'restoreUser'])->name('restoreUser');

Route::get('/updateU/{id}',[pharmacycontroller::class,'editUser'])->name('updateUserr'); 
Route::patch('/updateUser/{id}',[pharmacycontroller::class,'updateUser'])->name('updateUser');
Route::delete('/deleteU/{id}',[pharmacycontroller::class,'deleteU'])->name('deleteUser');

//settings
Route::get('/settings',function(){
    return view('admin.settings');
})->name('settings');

Route::get('/changeuse',function(){
    return view('admin.changeusername');
})->name('changeusername');

Route::get('/changepass/{id}',[pharmacycontroller::class,'changepassword'])->name('changepass');
Route::patch('/changepassword/{id}',[pharmacycontroller::class,'changepass'])->name('changepassword');
//changing email
Route::get('/changemail/{id}',[pharmacycontroller::class,'changeusername'])->name('changeusername');
Route::patch('/changeemail/{id}',[pharmacycontroller::class,'changeemail'])->name('changeemail');
//deleting account
Route::delete('/deleteAccount/{id}',[pharmacycontroller::class,'deleteAccount'])->name('deleteAccount');
Route::get('/afteradding',function(){
    return view('admin.afterAdding');
})->name('afterAdding');
Route::get('/afteroperation',function(){
    return view('admin.dashboardBack');
})->name('dashback');
//pharmacist
Route::get('/sales',function(){
    return view('pharmacist.salesp');

})->name('sales');
Route::get('/reportsp', [pharmacistController::class, 'salesReport'])->name('reportsp');
Route::post('/insertSalesp',[pharmacistController::class,'sales'])->name('insertsalesp');
//ph settings
Route::get('/settingsp',function(){
    return view('pharmacist.settings');
})->name('settingsp');
//ph features
Route::get('/changepassp/{id}',[pharmacistController::class,'changepasswordp'])->name('changepassp');
Route::patch('/changepasswordp/{id}',[pharmacistController::class,'changepassp'])->name('changepasswordp');
//changing email
Route::get('/changemailp/{id}',[pharmacistController::class,'changeusernamep'])->name('changeusernamep');
Route::patch('/changeemailp/{id}',[pharmacistController::class,'changeemailp'])->name('changeemailp');
Route::get('/afteroperationp',function(){
    return view('pharmacist.dashbackp');
})->name('dashbackp');