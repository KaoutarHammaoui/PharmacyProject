<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pharmacycontroller;
use App\Http\Controllers\pharmacistController;
use App\Http\Controllers\Adminncontroller;
use App\Http\Controllers\PharmmController;

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
    return redirect('login');
});
Route::get('login',function(){
    return view('loginInterface');
});
Route::post('login',[pharmacycontroller::class,'login'])->name('login');

Route::get('/addUser',function(){
    return view('admin.addUser');
})->name('addUserView');
Route::get('/addSup',function(){
    return view('admin.addSup');
})->name('addSupView');
Route::post('/insertUser',[pharmacycontroller::class,'addUser'])->name('addUser');
Route::get('/usersinfos', [pharmacycontroller::class,'getUsers'])->name('usersInfos');


Route::post('/insertSup',[pharmacycontroller::class,'addSup'])->name('addSup');
Route::get('/suppliersinfos', [pharmacycontroller::class,'getSups'])->name('suppliersinfos');

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

Route::get('/editSup/{id}',[pharmacycontroller::class,'editSup'])->name('editSup'); 
Route::patch('/updateSup/{id}', [pharmacycontroller::class, 'updateSup'])->name('updateSup');
Route::delete('/deleteSup/{id}',[pharmacycontroller::class,'deleteS'])->name('deleteSup');

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
Route::get('/afteroperationp', function() {
    return view('pharmacist.dashbackp');
})->name('dashbackp');


//admin's inventory

Route::get('/add-med', [Adminncontroller::class, 'showAddMed'])->name('addMed.show');

Route::post('/insertMed', [Adminncontroller::class, 'addMed'])->name('addMed.store');

Route::get('/medsinfos', [Adminncontroller::class,'getMeds'])->name('medsInfos');
Route::get('/viewMed/{id}', [Adminncontroller::class,'getMed'])->name('medInfos');

Route::get('/editMed/{id}',[Adminncontroller::class,'editMed'])->name('editMed'); 
Route::patch('/updateMed/{id}', [Adminncontroller::class, 'updateMed'])->name('updateMed');
Route::delete('/deleteMed/{id}',[Adminncontroller::class,'deleteMed'])->name('deleteMed');
Route::get('/shortagedMeds', [AdminnController::class, 'medsShortage'])->name('medsShortage');

//admin's dashboard    
Route::get('/admin/dashboard', [AdminnController::class, 'dashboard'])->name('dashboard');


//pharmacist's dashboard 
Route::get('/pharmacist/dashboard', [PharmmController::class, 'dashboard'])->name('dashboardp');

//pharmacist's inventory

Route::get('/add-medp', [PharmmController::class, 'showAddMed'])->name('addMedp.show');

Route::post('/insertMedp', [PharmmController::class, 'addMed'])->name('addMedp.store');

Route::get('/medsinfosp', [PharmmController::class,'getMeds'])->name('medsInfosp');
Route::get('/viewMedp/{id}', [PharmmController::class,'getMed'])->name('medInfosp');

Route::get('/editMedp/{id}',[PharmmController::class,'editMed'])->name('editMedp'); 
Route::patch('/updateMedp/{id}', [PharmmController::class, 'updateMed'])->name('updateMedp');
Route::delete('/deleteMedp/{id}',[PharmmController::class,'deleteMed'])->name('deleteMedp');
Route::get('/shortagedMedsp', [PharmmController::class, 'medsShortage'])->name('medsShortagep');
Route::get('/c',function(){
    return view('admin.cryptee');
});