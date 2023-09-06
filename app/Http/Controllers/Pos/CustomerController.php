<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{


    public function CustomerAll()
    {
        $customerAll = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customerAll'));
    } //end method

    public function CustomerAdd()
    {
        return view('backend.customer.customer_add');
    } //end method

    public function CustomerStore(Request $request)
    {
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(200, 200)->save('upload/customer_images/' . $name_gen);
            $save_url = 'upload/customer_images/' . $name_gen;


            Customer::insert([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'customer_image' => $save_url,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Customer Inserted Successfully With Image ',
                'alert_type' => 'success',
            );
        } else {
            Customer::insert([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'created_by' => Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Customer Inserted Successfully Without Image',
                'alert-type' => 'success',
            );
        }

        return redirect()->route('customer.all')->with($notification);
    }

    public function CustomerEdit($id)
    {
        $customerInfo = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customerInfo'));
    }

    public function CustomerUpdate(Request $request)
    {
        $customerId  =  $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(200, 200)->save('upload/customer_images/' . $name_gen);
            $save_url = 'upload/customer_images/' . $name_gen;

            Customer::findOrFail($customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'customer_image' => $save_url,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Customer Updated Successfully With Image',
                'alert-type' => 'success',
            );
        } else {
            Customer::findOrFail($customerId)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'address' => $request->address,
                'updated_by' => Auth::user()->id,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Customer Updated Successfully Without Image',
                'alert-type' => 'success',
            );
        }

        return redirect()->route('customer.all')->with($notification);
    } //end method

    public function CustomerDelete($id)
    {
        Customer::findOrFail($id)->delete();
        $payments = Payment::where('customer_id', $id)->get();

        foreach ($payments as $payment) {
            $inovoice_details = InvoiceDetail::where('invoice_id', $payment->invoice_id)->get();
            if ($inovoice_details != NULL) {
                foreach ($inovoice_details as $item) {
                    Invoice::where('id', $item->invoice_id)->delete();
                    PaymentDetail::where('invoice_id', $item->invoice_id)->delete();
                    InvoiceDetail::where('invoice_id', $item->invoice_id)->delete();
                }
            }
            Payment::where('customer_id', $payment->customer_id)->delete();
        }


        $notification = array(
            'message' => 'Company Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
