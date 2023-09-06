@extends('admin.admin_master')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Sales </h4><br><br>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Inv No</label>
                                        <input class="form-control" type="text" name="invoice_no"
                                            value="{{ $invoice_no }}" id="invoice_no" readonly style="background: #ddd;">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Date</label>
                                        <input type="date" value="{{ $date }}" class="form-control"
                                            name="date" id="date">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Category
                                            Name</label>
                                        <select name="category_id" id="category_id"
                                            class="form-control form-select select2">
                                            <option value="">Select Category Name</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Product
                                            Name</label>
                                        <select name="product_id" id="product_id" class="form-control form-select select2">
                                            <option selected value="">Select Product Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Stock </label>
                                        <input style="background: #ddd;" name="current_stock_qty" id="current_stock_qty"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                                {{-- <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Amount </label>
                                        <input style="background: #ddd;" name="current_stock_amount" id="current_stock_amount"
                                            class="form-control" readonly>
                                    </div>
                                </div> --}}
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label mt-4"></label>
                                        <i class="btn btn-secondary btn-rounded wave-effect wave-light fas fa-plus-circle"
                                            id="addEventMore">
                                            Add
                                            More</i>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="card-body">
                            <form method="POST" action="{{ route('invoice.store') }}">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" width="100%"
                                        style="border-color: #ddd;">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th width="7%">PSC/KG</th>
                                                <th width="10%">Unit Price</th>
                                                <th width="15%">Total Price</th>
                                                <th width="7%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">

                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="4">Discount Amount</td>
                                                <td>
                                                    <input type="number" name="discount_amount" id="discount_amount"
                                                        class="form-control discount_amount" placeholder="Discount Amount">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Grand Total</td>
                                                <td>
                                                    <input type="text" name="estimated_amount" id="estimated_amount"
                                                        class="form-control estimated_amount" style="background:#ddd;"
                                                        readonly value="0">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="row mb-4">
                                    <div class="form-group col-md-12">
                                        <textarea name="description" id="description" class="form-control" placeholder="Write Description"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <select class="form-control" name="paid_status" id="paid_status">
                                            <option value="">Select Paid Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Partial Paid</option>
                                        </select>
                                        <input type="text" placeholder="Enter Paid Amount" class="form-control"
                                            name="paid_amount" id="paid_amount" style="display:none;">
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control" name="customer_id" id="customer_id">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }} -
                                                    {{ $customer->mobile_no }}</option>
                                            @endforeach
                                            <option value="0">New Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="new_customer" style="display: none;">
                                    <div class="form-group col-md-4">
                                        <input type="text" name="name" id="name" placeholder="Customer Name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="tel" name="mobile_no" id="mobile_no"
                                            placeholder="Customer Mobile No" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="email" name="email" id="email" placeholder="Customer Email"
                                            class="form-control">
                                    </div>

                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-info" id="storeButton">Sales Store</button>
                                </div>
                            </form>
                        </div>




                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>





    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{ date }}">
            <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">

            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td width="4%">
                <input type="number" min="1" class="form-control selling_qty text-right" name="selling_qty[]"
                    value="">
            </td>
            <td width="10%">
                <input type="number" min="1" class="form-control unit_price text-right" name="unit_price[]"
                    value="">
            </td>

            <td>
                <input type="number" min="1" class="form-control selling_price text-right" name="selling_price[]"
                    value="0" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fas fa-window-close" id="removeEventMore"></i>
            </td>
        </tr>
    </script>


    {{--  add more purchase   --}}
    <script>
        $(document).ready(function() {
            $(document).on("click", "#addEventMore", function() {
                console.log("clicked");

                let date = $("#date").val();
                let invoice_no = $("#invoice_no").val();
                let category_id = $("#category_id").val();
                let category_name = $("#category_id").find('option:selected').text();
                let product_id = $("#product_id").val();
                let product_name = $("#product_id").find('option:selected').text();

                if (date == '') {
                    $.notify("Date is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                if (category_id == '') {
                    $.notify("Category is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (product_id == '') {
                    $.notify("{Product field is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }


                let source = $("#document-template").html();
                let template = Handlebars.compile(source);

                let data = {
                    date: date,
                    invoice_no: invoice_no,
                    category_id: category_id,
                    category_name: category_name,
                    product_id: product_id,
                    product_name: product_name,
                };
                console.log('date', data);
                let html = template(data);
                $("#addRow").append(html);


            });


            $(document).on("click", "#removeEventMore", function() {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });


            $(document).on("keyup click", ".unit_price,.selling_qty", function() {
                let unit_price = $(this).closest("tr").find('input.unit_price').val();
                let selling_qty = $(this).closest("tr").find('input.selling_qty').val();
                let total = unit_price * selling_qty;
                $(this).closest("tr").find('input.selling_price').val(total);
                $("#discount_amount").trigger('keyup');
            });

            $(document).on('keyup', '#discount_amount', function() {
                totalAmountPrice();
            });

            //  calculate sum amount for invoice

            function totalAmountPrice() {
                let sum = 0;
                $('.selling_price').each(function() {
                    let value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });


                let discount_amount = parseFloat($('#discount_amount').val());
                if (!isNaN(discount_amount) && discount_amount.length != 0) {
                    sum -= parseFloat(discount_amount);
                }

                $("#estimated_amount").val(sum);
            }

        });
    </script>



    {{--  dropdown menu select  --}}
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#category_id').on('change', function() {
                let categoryId = $(this).val();
                console.log('category_id', categoryId);
                $.ajax({
                    url: '{{ route('get.product') }}?category_id=' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        let html = '<option value="">Select Product </option>';
                        $.each(data, function(key, value) {
                            html += '<option value=" ' + value.id + ' "> ' +
                                value.name + '</option>';
                        });
                        $("#product_id").html(html);
                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#product_id').on('change', function() {
                let productId = $(this).val();
                console.log('product_id', productId);
                $.ajax({
                    url: '{{ route('get.product.stock') }}?product_id=' + productId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $("#current_stock_qty").val(data);
                        $("#current_stock_amount").val(data);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#paid_status').on('change', function() {
                let paidStatus = $(this).val();
                if (paidStatus == 'partial_paid') {
                    $('#paid_amount').show();
                } else {
                    $('#paid_amount').hide();
                }
            });


            $('#customer_id').on('change', function() {
                let customerId = $(this).val();
                console.log(customerId);
                if (customerId == '0') {
                    $('#new_customer').show();
                } else {
                    $('#new_customer').hide();
                }
            });
        });
    </script>
@endsection
