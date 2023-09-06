<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Support\Carbon;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ProductController extends Controller
{
    public function ProductAll(){
        $productAll = Product::all();
        return view('backend.product.product_all', compact('productAll'));
    }


    public function ProductAdd(){
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('backend.product.product_add', compact('suppliers', 'categories','units'));
    }

    public function ProductStore(Request $request){
        Product::insert([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'quantity' => '0',
            'created_by' => FacadesAuth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array([
            'message' => 'Product Inserted Successfully',
            'alert_type' => 'success',
        ]);
        return redirect()->route('product.all')->with($notification);
    }

    public function ProductEdit($id){
        $category = Category::all();
        $supplier = Supplier::all();
        $unit = Unit::all();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit',compact('product', 'supplier', 'category','unit'));
    }

    public function ProductUpdate(Request $request){
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array([
            'message' => 'Product Updated Successfully',
            'alert_type' => 'success',
        ]);
        return redirect()->route('product.all')->with($notification);
    }

    public function ProductDelete($id){
        Product::findOrFail($id)->delete();
        $notification = array([
            'message' => 'Product Deleted Successfully',
            'alert_type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }
}
