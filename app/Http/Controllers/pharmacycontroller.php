<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\salesModel;
use App\Models\Product;
class pharmacycontroller extends Controller
{
    public function login(Request $request){
         $userData= $request->only('email','password');
         if(Auth::attempt($userData)){        /**f the credentials are valid (f they exist in the databasa, the mail should exists in the database and the password must matches the one which exists in the db)we're gonna enter to the if block. the auth is a facade in laravel and when we use it with the attempt method we make it do the login logic when it verifies and logs the user in */
            $user= Auth::user(); /**behind the scene laravel uses the User model and make a find($id) statement then brings the usser's info identicated in that moment */
            if($user->role==='admin'){
                return redirect()->route('dashboard');

            }

            elseif($user->role==='pharmacist'){
                return redirect()->route('dashboardp');
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

public function salesReport()
{
    // Get sales data
    $todaySales = salesModel::dailySales();
    $yesterdaySales = salesModel::dailySales(now()->subDay()->toDateString());
    $thisMonthSales = salesModel::monthlySales();
    $lastMonthSales = salesModel::monthlySales(now()->subMonth()->month, now()->subMonth()->year);
    
    // Paginate recent sales - 5 per page
    $recentSales = salesModel::with('product')->orderBy('created_at', 'desc')->paginate(5);
    
    // Get products with their total stock quantities
    $products = Product::with('stocks')
        ->get()
        ->filter(function($product) {
            return $product->total_quantity > 0; // Only show products with stock
        });
    
    return view('admin.reports', compact(
        'todaySales',
        'yesterdaySales', 
        'thisMonthSales',
        'lastMonthSales',
        'recentSales',
        'products'
    ));
}

public function sales(Request $request){
    // Validate the request
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity_sold' => 'required|integer|min:1',
        'tot' => 'required|numeric|min:0',
        'CD' => 'nullable|date'
    ]);

    $user = Auth::user();
    
    // Get product and check total available stock
    $product = Product::with('stocks')->find($request->product_id);
    $totalStock = $product->stocks()->sum('quantite');
    
    if ($totalStock < $request->quantity_sold) {
        return back()->withErrors(['quantity_sold' => 'Stock insuffisant. Stock disponible: ' . $totalStock]);
    }
    
    // Create the sale record
    salesModel::create([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'product_id' => $request->product_id,
        'quantity_sold' => $request->quantity_sold,
        'created_at' => $request->CD ?? now(),
        'total' => $request->tot,
    ]);

    // Reduce stock using FIFO (First In, First Out) - oldest stock first
    $remainingToReduce = $request->quantity_sold;
    $stocks = $product->stocks()->where('quantite', '>', 0)->orderBy('created_at')->get();
    
    foreach ($stocks as $stock) {
        if ($remainingToReduce <= 0) break;
        
        if ($stock->quantite >= $remainingToReduce) {
            // This stock has enough quantity
            $stock->decrement('quantite', $remainingToReduce);
            $remainingToReduce = 0;
        } else {
            // Use all of this stock and continue to next
            $remainingToReduce -= $stock->quantite;
            $stock->update(['quantite' => 0]);
        }
    }

    return redirect()->route('dashback')->with('success', 'Vente enregistrée avec succès!');
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
