<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function InvoiceAll()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('date', 'desc')->where('status', '1')->get();
        return view('backend.invoice.invoice_all', compact('allData'));
    }

    public function InvoiceAdd()
    {
        $invoice_data = Invoice::orderBy('id', 'desc')->first();
        if ($invoice_data == null) {
            $firstReg = '0';
            $invoice_no = $firstReg + 1;
        } else {
            $invoice_data = Invoice::orderBy('id', 'desc')->first()->invoice_no;
            $invoice_no = $invoice_data + 1;
        }
        $date = date('Y-m-d');
        $categories = Category::all();
        $customers = Customer::all();
        return view('backend.invoice.invoice_add', compact('invoice_no', 'categories', 'date', 'customers'));
    } //end method


    public function InvoiceStore(Request $request)
    {
        if ($request->category_id == null) {
            $notification = array(
                'message' => 'Sorry, you do not select any item',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            if ($request->paid_amount > $request->estimated_amount) {
                $notification = array(
                    'message' => 'Sorry, Paid amount is maximum the total amount',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            } else {
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no;
                $invoice->date = date('Y-m-d', strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = '1';
                $invoice->created_by = Auth::user()->id;

                DB::transaction(function () use ($request, $invoice) {
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i = 0; $i < $count_category; $i++) {

                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d', strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_qty = $request->selling_qty[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price[$i];
                            $invoice_details->status = '1';


                            // product stock updated
                            $product = Product::where('id', $invoice_details->product_id)->first();
                            $product->quantity = ((float) $product->quantity) - ((float) $request->selling_qty[$i]);
                            $product->save();

                            $invoice_details->save();
                        }

                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->email = $request->email;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else {
                            $customer_id = $request->customer_id;
                        }


                        $payment = new Payment();
                        $payment_details = new PaymentDetail();
                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->due_amount = $request->due_amount;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;

                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        } elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();

                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d', strtotime($request->date));
                        $payment_details->save();
                    }
                });
            } //end else

        }
        $notification = array(
            'message' => 'Invoice Data Inserted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('invoice.all')->with($notification);
    } //end method



    public function InvoicePending()
    {
        $allData = Invoice::orderBy('date', 'desc')->orderBy('date', 'desc')->where('status', '')->get();
        return view('backend.invoice.invoice_pending_list', compact('allData'));
    }

    public function InvoiceDelete($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        InvoiceDetail::where('invoice_id', $invoice->id)->delete();
        Payment::where('invoice_id', $invoice->id)->delete();
        PaymentDetail::where('invoice_id', $invoice->id)->delete();

        $notification = array(
            'message' => 'Invoice Data Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    } //end method

    public function InvoiceApproved($id)
    {
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        return view('backend.invoice.invoice_approved', compact('invoice'));
    } //end method


    public function ApprovalStore(Request $request, $id)
    {
        foreach ($request->selling_qty as $key => $val) {
            $invoice_details = InvoiceDetail::where('id', $key)->first();
            $product = Product::where('id', $invoice_details->product_id)->first();
            if ($product->quantity < $request->selling_qty[$key]) {
                $notification = array(
                    'message' => 'Sorry, You approved maximum value',
                    'alert-type' => 'error',
                );
                return redirect()->back()->with($notification);
            }
        }

        $invoice = Invoice::findOrFail($id);
        $invoice->updated_by = Auth::user()->id;
        $invoice->status = '1';

        DB::transaction(function () use ($request, $invoice, $id) {
            foreach ($request->selling_qty as $key => $val) {
                $invoice_details = InvoiceDetail::where('id', $key)->first();
                $product = Product::where('id', $invoice_details->product_id)->first();
                $product->quantity = ((float) $product->quantity) - ((float) $request->selling_qty[$key]);
                $product->save();
            };
            $invoice->save();
        });

        $notification = array(
            'message' => 'Invoice Approved Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('invoice.pending.list')->with($notification);
    } //end method

    public function InvoicePrint($id)
    {
        $invoice = Invoice::with('invoice_details')->findOrFail($id);
        return view('backend.pdf.invoice_pdf', compact('invoice'));
    }

    // invoice report all method
    public function DailySalesReport()
    {
        return view('backend.report.daily_sales_report');
    } //end method

    public function DailySalesReportPdf(Request $request)
    {
        // dd($request->all());
        $sdate = date('Y-m-d', strtotime($request->start_date));
        $edate = date('Y-m-d', strtotime($request->end_date));
        $allData = Invoice::whereBetween('date', [$sdate, $edate])->get();
        return view('backend.report.daily_sales_report_pdf', compact('allData', 'sdate', 'edate'));
        // dd($allData);
    }
}
