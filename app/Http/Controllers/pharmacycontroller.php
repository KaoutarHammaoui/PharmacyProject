<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
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
    public function addUser(Request $request){
        User::create([
            'name'=>$request->nom,
            'email'=>$request->mail,
            'password'=>bcrypt($request->pass),
            'role'=>$request->role,

        ]);
        return response('User added successfully');
    }
    public function logOut(){
        Auth::logout();
         request()->session()->invalidate();
         request()->session()->regenerateToken();
        return redirect('/login');
    }
}
