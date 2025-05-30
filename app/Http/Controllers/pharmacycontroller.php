<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\salesModel;
class pharmacycontroller extends Controller
{
    public function login(Request $request){
         $userData= $request->only('email','password');
         if(Auth::attempt($userData)){        /**f the credentials are valid (f they exist in the databasa, the mail should exists in the database and the password must matches the one which exists in the db)we're gonna enter to the if block. the auth is a facade in laravel and when we use it with the attempt method we make it do the login logic when it verifies and logs the user in */
            $user= Auth::user(); /**behind the scene laravel uses the User model and make a find($id) statement then brings the usser's info identicated in that moment */
            if($user->role==='admin'){
                return redirect()->route('admin.dashboard');

            }

            elseif($user->role==='pharmacist'){
                return redirect()->route('pharmacist.dashboard');
            }
             else {
            return back()->withErrors(['role' => 'Rôle inconnu']);
            }
        }
        return back()->withErrors(['email' => 'Coordonnées incorrectes']);
    }
      public function indexadmin()
    {
        return view('admin.dashboard'); 
    }

    public function indexpharmacist()
    {
        return view('pharmacist.dashboard'); 
    }
    public function getUsers(){
        $users= User::get();
        return view('admin.usersInfos',compact('users'));
    }
    public function addUser(Request $request){
        User::create([
            'name'=>$request->nom,
            'email'=>$request->mail,
            'password'=>bcrypt($request->pass),
            'role'=>$request->role,

        ]);
        return view('admin.afterAdding');
    }
    public function updateUser(Request $request){
        User::where('id',$request->id)->update([
            'name'=>$request->fullname,
            'email'=>$request->mail,
            'password'=>bcrypt($request->pass),
            'role'=>$request->role,
        ]);
        return view('admin.afterAdding');
    }
    public function editUser($id){
       $user = User::findOrFail($id);
        return view('admin.updateUser',compact('user'));
    }
   public function deleteU($id){
    User::where('id', $id)->delete(); 
    return view('admin.afterAdding');
}
public function backupDeletedUsers()
{
    $deletedUsers = User::onlyTrashed()->get();
    return view('admin.backUp', compact('deletedUsers'));
}
public function restoreUser($id)
{
    $user = User::onlyTrashed()->findOrFail($id);
    $user->restore();
    return redirect()->route('backUp')->with('success', 'User restored successfully!');
}
//logout

    public function logOut(){
        Auth::logout();
         request()->session()->invalidate();
         request()->session()->regenerateToken();
        return redirect('login');
    }

   

public function sales(Request $request){
    $user = Auth::user(); // Get currently logged-in user
    
    salesModel::create([
        'user_id' => $user->id,
        'user_name' => $user->name, // Store the name
        'created_at' => $request->CD ?? now(),
        'total' => $request->tot,
    ]);
      return redirect()->route('dashback')->with('success', 'Sale recorded successfully!');

}
public function salesReport()
{
    // Get sales data
    $todaySales = salesModel::dailySales();
    $yesterdaySales = salesModel::dailySales(now()->subDay()->toDateString());
    $thisMonthSales = salesModel::monthlySales();
    $lastMonthSales = salesModel::monthlySales(now()->subMonth()->month, now()->subMonth()->year);
    
    // Paginate recent sales - 5 per page
    $recentSales = salesModel::orderBy('created_at', 'desc')->paginate(5);
    
    return view('admin.reports', compact(
        'todaySales',
        'yesterdaySales', 
        'thisMonthSales',
        'lastMonthSales',
        'recentSales'
    ));
}
//settings features
public function changepass(Request $request,$id){
    User::where('id',$id)->update([
        'password'=>bcrypt($request->pass),
    ]);
    return redirect()->route('dashback')->with('success', 'Password changed successfully!');
    
}

public function changepassword($id){
       $user = User::findOrFail($id);
        return view('admin.changepass',compact('user'));
}
//change username
public function changeemail(Request $request,$id){
    User::where('id',$id)->update([
        'email'=>$request->email,
    ]);
    return redirect()->route('dashback')->with('success', 'email changed successfully!');
    
}

public function changeusername($id){
       $user = User::findOrFail($id);
        return view('admin.changeusername',compact('user'));
}
//delete account
public function deleteAccount($id){
    User::where('id', $id)->delete(); 
    return redirect()->route('login')->with('successfully deleted');
}


}
//settings
