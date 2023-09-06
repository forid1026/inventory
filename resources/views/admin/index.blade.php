@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Inventory</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Received</p>
                                    <h4 class="mb-2">{{ number_format($dailySalesRecieved + $dueAmount) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Daily Sales</p>
                                    <h4 class="mb-2">{{ number_format($productSaleDaily) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Daily Received</p>
                                    <h4 class="mb-2">{{ number_format($dailySalesRecieved) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Daily Due Received</p>
                                    <h4 class="mb-2">{{ number_format($dueAmount) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Due</p>
                                    <h4 class="mb-2">{{ number_format($totalDueAmount) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Products</p>
                                    <h4 class="mb-2">{{ count($products) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Suppliers</p>
                                    <h4 class="mb-2">{{ count($suppliers) }}</h4>
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="ri-user-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>

                            </div>

                            <h4 class="card-title mb-4">Products Stock</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Product Name</th>
                                            <th>Supplier Name</th>
                                            <th>In Qty</th>
                                            <th>Out Qty</th>
                                            <th>Stock</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Product Name</th>
                                            <th>Supplier Name</th>
                                            <th>In Qty</th>
                                            <th>Out Qty</th>
                                            <th>Stock</th>
                                            <th>Amount</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            @php
                                                $purchases = App\Models\Purchase::where('supplier_id', $product->supplier_id)
                                                    ->where('product_id', $product->id)
                                                    ->where('status', '1')
                                                    ->get();
                                                $selling = App\Models\InvoiceDetail::where('category_id', $product->category_id)
                                                    ->where('product_id', $product->id)
                                                    ->where('status', '1')
                                                    ->get();
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $key + 1 }}
                                                </td>
                                                <td>
                                                    <h6 class="mb-0">{{ $product->name }}</h6>
                                                </td>
                                                <td>{{ $product['supplier']['name'] }}</td>
                                                <td>
                                                    {{ $purchases->sum('buying_qty') }}
                                                </td>
                                                <td>
                                                    {{ number_format ($selling->sum('selling_qty')) }}
                                                </td>
                                                <td>
                                                    {{ $product->quantity }}
                                                </td>
                                                <td>
                                                    {{ number_format($purchases->sum('buying_price') )}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
            </div>

        </div>
    @endsection
