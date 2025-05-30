<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\salesModel;

class pharmacistController extends Controller
{
    public function sales(Request $request){
    $user = Auth::user(); // Get currently logged-in user
    
    salesModel::create([
        'user_id' => $user->id,
        'user_name' => $user->name, // Store the name
        'created_at' => $request->CD ?? now(),
        'total' => $request->tot,
    ]);
      return redirect()->route('dashbackp')->with('success', 'Sale recorded successfully!');

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
    
    return view('pharmacist.salesp', compact(
        'todaySales',
        'yesterdaySales', 
        'thisMonthSales',
        'lastMonthSales',
        'recentSales'
    ));
}
//settings pharmacist

public function changepassp(Request $request,$id){
    User::where('id',$id)->update([
        'password'=>bcrypt($request->pass),
    ]);
    return redirect()->route('dashbackp')->with('success', 'Password changed successfully!');
    
}

public function changepasswordp($id){
       $user = User::findOrFail($id);
        return view('pharmacist.changepass',compact('user'));
}
//change username
public function changeemailp(Request $request,$id){
    User::where('id',$id)->update([
        'email'=>$request->email,
    ]);
    return redirect()->route('dashbackp')->with('success', 'email changed successfully!');
    
}
public function changeusernamep($id){
       $user = User::findOrFail($id);
        return view('pharmacist.changemailp',compact('user'));
}
}
