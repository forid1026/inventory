@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Due Payment</h6>
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="{{ route('due.payment.add') }}">
                    <button class="btn btn-info"><i class="fa fa-plus-circle" aria-hidden="true"> Add Due Payment </i></button>
                </a>
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
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @php
                                        $total_due = App\Models\DuePayment::sum('payment_amount');
                                    @endphp
                                    <h4 class="text-muted text-center">Total Due: {{$total_due}} </h4>
                                    @foreach ($allPayment as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                {{ $item->customer_name }}
                                            </td>
                                            <td>
                                                #{{ $item->invoice_no }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($item->date)) }}
                                            </td>
                                            <td>
                                                {{ $item->payment_amount }}
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
