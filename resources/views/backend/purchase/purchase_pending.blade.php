@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Pending Purchase</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('purchase.add') }}">
                    <button class="btn btn-info"> <i class="fa fa-plus-circle" aria-hidden="true">  Add Purchase </i> </button>
                </a>
            </h6>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Purchase No</th>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Qty</th>
                                                <th>Produc Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Purchase No</th>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Category</th>
                                                <th>Qty</th>
                                                <th>Produc Name</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach ($allData as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        {{ $item->purchase_no }}
                                                    </td>
                                                    <td>
                                                        {{ date('d-m-y', strtotime($item->date)) }}
                                                    </td>
                                                    <td>
                                                        {{ $item['supplier']['name'] }}
                                                    </td>
                                                    <td>
                                                        {{ $item['category']['name'] }}
                                                    </td>
                                                    <td>
                                                        {{ $item->buying_qty }}
                                                    </td>
                                                    <td>
                                                        {{ $item['product']['name'] }}
                                                    </td>
                                                    <td>
                                                        @if ($item->status == '0')
                                                            <span class="btn btn-warning">Pending</span>
                                                        @elseif($item->stuatus == '1')
                                                        <span class="btn btn-warning">Approved</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->status == '0')
                                                            <a id="approvedBtn" style="margin-left: 5px;"
                                                                href="{{ route('purchase.approve', $item->id) }}"
                                                                class="btn btn-danger" title="Approved">
                                                                <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                            </a>
                                                        @endif
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
@endsection
