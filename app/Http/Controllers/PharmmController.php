<?php


namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\User;     
use App\Models\Supplier; 
use App\Models\salesModel;
use Illuminate\Support\Facades\DB;

class PharmmController extends Controller
{
    public function getMeds()
    {
        $products = Product::get();
        return view('pharmacist.medsInfosp', compact('products'));
    }

    public function getMed($id)
    {
        $product = Product::with('stocks', 'equivalents')->findOrFail($id);
        return view('pharmacist.medInfosp', compact('product'));
    }

    public function showAddMed()
    {
        $products = Product::all();
        return view('pharmacist.addMedp', compact('products'));
    }

    public function addMed(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'codeBar' => 'required|string|max:255',
            'withRecepie' => 'required|boolean',
            'threshold' => 'required|integer|min:0',
            'quantite' => 'required|integer|min:0',
            'description' => 'required|string|max:3000',
            'date_expiration' => 'required|date',
            'equivalents' => 'sometimes|array',
            'equivalents.*' => 'integer|exists:products,id',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'codeBar' => $request->codeBar,
            'withRecepie' => $request->withRecepie,
            'threshold' => $request->threshold,
            'description' => $request->description,
        ]);

        if (method_exists($product, 'stocks')) {
            $product->stocks()->create([
                'quantite' => $request->quantite,
                'date_expiration' => $request->date_expiration,
            ]);
        }

        if ($request->has('equivalents')) {
            $product->equivalents()->sync($request->input('equivalents'));
        } else {
            $product->equivalents()->sync([]);
        }

        return view('pharmacist.successMeds');
    }

    public function editMed($id)
    {
        $product = Product::with('equivalents')->findOrFail($id);
        $allProducts = Product::all();
        $currentEquivalentIds = $product->equivalents->pluck('id')->toArray();

        return view('pharmacist.updateMedp', compact('product', 'allProducts', 'currentEquivalentIds'));
    }

   public function updateMed(Request $request, $id)
    {
        $product = Product::findOrFail($id); 

        $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'codeBar' => 'required|string|max:255|unique:products,codeBar,' . $product->id,
            'withRecepie' => 'required|boolean',
            'threshold' => 'required|integer|min:0',
            'description' => 'required|string|max:3000',
            'quantite' => 'sometimes|required|integer|min:0', 
            'date_expiration' => 'sometimes|required|date',     
            'equivalents' => 'sometimes|array',
            'equivalents.*' => 'integer|exists:products,id',
        ]);

        $product->update([
            'name' => $request->name,
            'codeBar' => $request->codeBar,
            'withRecepie' => $request->withRecepie,
            'threshold' => $request->threshold,
            'description' => $request->description,
        ]);

        if ($product->stocks) {
            $stockDataToUpdate = [];
            if ($request->filled('quantite')) {
                $stockDataToUpdate['quantite'] = $request->quantite;
            }
            if ($request->filled('date_expiration')) {
                $stockDataToUpdate['date_expiration'] = $request->date_expiration;
            }
           if (!empty($stockDataToUpdate)) {
    $product->stocks()->update($stockDataToUpdate);
}
        }

        $product->equivalents()->sync($request->input('equivalents', []));
        return view('pharmacist.successMeds');
    }

    public function deleteMed($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return view('pharmacist.successMeds');
    }

    public function medsShortage()
    {
        $allProducts = Product::with('stocks')->get();

        $shortageProducts = $allProducts->filter(function ($product) {
            return $product->total_quantity <= $product->threshold;
        })->sortBy(function ($product) {
            return [$product->total_quantity, $product->name];
        });

        return view('pharmacist.medsShortagep', compact('shortageProducts'));
    }

    public function dashboard()
    {
        $totalStockQuantity = Stock::sum('quantite');

        $allProductsForShortageCheck = Product::with('stocks')->get();
        $shortageProductsCount = $allProductsForShortageCheck->filter(function ($product) {
            return $product->total_quantity <= $product->threshold;
        })->count();

        $totalSuppliers = 0;
        if (class_exists(Supplier::class)) {
            $totalSuppliers = Supplier::count();
        }

        return view('pharmacist.dashboardp', compact(
            'totalStockQuantity',
            'shortageProductsCount',
            'totalSuppliers'
        ));
    }
}
