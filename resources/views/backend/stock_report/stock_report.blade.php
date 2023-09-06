@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Stock Report</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a target="_blank" href="{{ route('stock.report.print') }}" class="btn btn-info waves-effect waves-light "><i
                        class="fa fa-print"></i> Stock Report Print</a>
            </h6>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Supplier Name</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>In Qty</th>
                                        <th>Out Qty</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Supplier Name</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>In Qty</th>
                                        <th>Out Qty</th>
                                        <th>Stock</th>
                                    </tr>
                                    </tr>
                                </tfoot>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
@endsection
