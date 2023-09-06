<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DuePayment;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function DuePaymentAll(){
        $allPayment = DuePayment::all();
        return view('backend.due_payment.all_due_payment', compact('allPayment'));
    }
    public function DuePaymentAdd()
    {
        $customers = Customer::all();
        $invoiceAll = Invoice::all();
        return view('backend.due_payment.add_due_payment', compact('customers', 'invoiceAll'));
    }

    public function DuePaymentStore(Request $request)
    {
        DuePayment::insert([
            'invoice_no' => $request->invoice_no,
            'customer_name' => $request->customer_name,
            'date' => $request->date,
            'payment_amount' => $request->payment_amount,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Due Payment Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.dashboard')->with($notification);
    }
}
