<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class pharmacycontroller extends Controller
{
    public function login(Request $request){
         $userData= $request->only('email','password');
         if(Auth::attempt($userData)){
            $user= Auth::user();
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
}
