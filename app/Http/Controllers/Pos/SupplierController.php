<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class SupplierController extends Controller
{
    public function SupplierAll()
    {
        $supplierAll = Supplier::latest()->get();
        return view('backend.supplier.supplier_all', compact('supplierAll'));
    } //end method

    public function SupplierAdd()
    {
        return view('backend.supplier.supplier_add');
    } //end method

    public function SupplierStore(Request $request)
    {
        Supplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);


        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('supplier.all')->with($notification);
    }

    public function SupplierEdit($id)
    {
        $supplierInfo = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_edit', compact('supplierInfo'));
    }

    public function SupplierUpdate(Request $request)
    {
        $supplierId  =  $request->id;
        Supplier::findOrFail($supplierId)->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('supplier.all')->with($notification);
    } //end method

    public function SupplierDelete($id)
    {

        Supplier::findOrFail($id)->delete();
        Purchase::where('supplier_id',$id)->delete();
        $products = Product::OrderBy('name', 'asc')->get();

        foreach ($products as $product) {
            Product::where('supplier_id', $id)->delete();
            $inovoice_details = InvoiceDetail::where('product_id', $product->id)->get();
            if ($inovoice_details != NULL) {
                foreach ($inovoice_details as $item) {
                    Invoice::where('id', $item->invoice_id)->delete();
                    Payment::where('invoice_id', $item->invoice_id)->delete();
                    PaymentDetail::where('invoice_id', $item->invoice_id)->delete();
                    InvoiceDetail::where('invoice_id', $item->invoice_id)->delete();
                }
            }
        }

        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
