<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function GetCategory(Request $request)
    {
        $supplier_id = $request->supplier_id;
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
        // dd($allCategory);
    }

    public function GetProduct(Request $request)
    {
        $category_id = $request->category_id;
        $allProduct = Product::where('category_id', $category_id)->get();
        return response()->json($allProduct);
        // dd($allCategory);
    }
    public function GetStock(Request $request)
    {
        $product_id = $request->product_id;
        $stock = Product::where('id', $product_id)->first()->quantity;
        $stock_amount = Purchase::where('product_id', $product_id)->sum('buying_price');
        return response()->json($stock);
    }
}
