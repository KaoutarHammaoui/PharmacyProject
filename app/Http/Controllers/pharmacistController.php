<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\salesModel;

class pharmacistController extends Controller
{
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
    
    return view('pharmacist.salesp', compact(
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

    return redirect()->route('dashbackp')->with('success', 'Vente enregistrée avec succès!');
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
