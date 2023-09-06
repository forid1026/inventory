<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function PurchaseAll()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.purchase.purchase_all', compact('allData'));
    }

    public function PurchaseAdd()
    {
        $suppliers = Supplier::all();
        $purchaseAll = Purchase::all();
        return view('backend.purchase.purchase_add', compact('purchaseAll', 'suppliers'));
    }

    public function PurchaseStore(Request $request)
    {
        if ($request->category_id == null) {
            $notification = array(
                'message' => 'Sorry, you do not select any item',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            $count_category = count($request->category_id);
            for ($i = 0; $i < $count_category; $i++) {
                $purchase = new Purchase();
                $product = new Product();
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->description = $request->description[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->unit_price = $request->unit_price[$i];

                $purchase->created_by = Auth::user()->id;
                $purchase->status = '1';


                // product quantity update
                $product = Product::where('id', $purchase->product_id)->first();
                $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
                $product->quantity = $purchase_qty;

                $purchase->save();
                $product->save();
            } //end for loop

            $notification = array(
                'message' => 'Purchase Added Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('purchase.all')->with($notification);
        } //end else condition

    } //end method


    public function PurchaseDelete($id)
    {
        Purchase::findOrFail($id)->delete();

        $notification = array([
            'message' => 'Purchase Deleted successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    } //end method

    // public function PurchasePending(){
    //     $allData = Purchase::orderBy('date','desc')->orderBy('id', 'desc')->where('status', '0')->get();
    //     return view('backend.purchase.purchase_pending', compact('allData'));
    // }

    // public function PurchaseApprove($id){

    //     $purchase = Purchase::findOrFail($id);
    //     $product = Product::where('id',$purchase->product_id)->first();
    //     $purchase_qty = ((float)($purchase->buying_qty)) + ((float)($product->quantity));
    //     $product->quantity = $purchase_qty;

    //     if($product->save()){
    //         Purchase::findOrFail($id)->update([
    //             'status' => '1',
    //         ]);
    //     }


    //     $notification = array(
    //         'message' => 'Purchase Approved successfully',
    //         'alert-type' => 'success',
    //     );

    //     return redirect()->route('purchase.all')->with($notification);
    // }
}
