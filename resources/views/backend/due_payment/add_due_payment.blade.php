@extends('admin.admin_master')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Due Payment </h4><br><br>
                            <form method="post" action="{{ route('due.payment.store') }}" id="myForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Inv No</label>
                                            <select name="invoice_no" id="invoice_no" class="form-control">
                                                <option value="" disabled selected>Select Invoice Number</option>
                                                @foreach ($invoiceAll as $invoice)
                                                    <option value="{{ $invoice->invoice_no }}">{{ $invoice->invoice_no }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Customer
                                                Name</label>
                                            <select name="customer_name" id="customer_name"
                                                class="form-control form-select select2">
                                                <option value="">Select Customer Name</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->name }}">
                                                        {{ $customer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Date</label>
                                            <input type="date" class="form-control date_picker" name="date"
                                                id="date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-sm-12 col-form-label"> Payment Amount
                                            </label>
                                            <input type="number" name="payment_amount" id="payment_amount"
                                                class="form-control" placeholder="Payment Amount">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="col-sm-12 col-form-label mt-3"></label>
                                            <input type="submit" class="btn btn-info" value="Add Payment">
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>


                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>





    <script>
        $(document).ready(function() {
            $("#myForm").validate({
                rules: {
                    invoice_no: {
                        required: true,
                    },
                    customer_name: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    payment_amount: {
                        required: true,
                    }
                },
                message: {
                    invoice_no: {
                        required: "Select Invoice No",
                    },
                    customer_name: {
                        required: "Please Enter your Customer Id",
                    },
                    date: {
                        required: "Please Enter Payment Date",
                    },
                    payment_amount: {
                        required: "Please Enter Payment Amount",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-faedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endsection
