@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Stock Report</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Stock Report</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    {{-- <div class="invoice-title">
                                        <h4 class="float-end font-size-16"><strong>Invoice No:
                                                #{{ $invoice->invoice_no }}</strong></h4>
                                        <h3 class="d-flex align-items-center">
                                            <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo"
                                                height="24" /> <span class="text-muted"> Rupa Printing House</span>
                                        </h3>
                                    </div>
                                    <hr> --}}
                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <address>
                                                <h3 class="text-muted">Company Name</h3>
                                                <h5 class="text-muted">Company Address</h5>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Supplier Name</th>
                                                            <th>Category</th>
                                                            <th>Product Name</th>
                                                            <th>In Qty</th>
                                                            <th>Out Qty</th>
                                                            <th>Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($allData as $key => $item)
                                                            @php
                                                                $buying_qty = App\Models\Purchase::where('supplier_id', $item->supplier_id)
                                                                    ->where('product_id', $item->id)
                                                                    ->where('status', '1')
                                                                    ->sum('buying_qty');
                                                                $selling_qty = App\Models\InvoiceDetail::where('category_id', $item->category_id)
                                                                    ->where('product_id', $item->id)
                                                                    ->where('status', '1')
                                                                    ->sum('selling_qty');
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    {{ $item['supplier']['name'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $item['category']['name'] }}
                                                                </td>
                                                                <td>
                                                                    {{ $item->name }}
                                                                </td>
                                                                <td>{{ $buying_qty }}</td>
                                                                <td>{{ $selling_qty }}</td>
                                                                <td>
                                                                    {{ $item->quantity }}
                                                                    {{ $item['unit']['name'] }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @php
                                                $date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
                                            @endphp
                                            <i>Printing Time : {{ $date->format('F j, Y, g:i a') }}</i>
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="fa fa-print"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->


                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
@endsection
