@extends('admin.admin_master')
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Purchase </h4><br><br>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Date</label>
                                        <input type="date" class="form-control date_picker" name="date"
                                            id="date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Purchase No</label>
                                        <input class="form-control" type="text" name="purchase_no" id="purchase_no">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Supplier
                                            Name</label>
                                        <select name="supplier_id" id="supplier_id"
                                            class="form-control form-select select2">
                                            <option selected value="">Select Supplier Name</option>
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}">
                                                    {{ $supplier->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Category
                                            Name</label>
                                        <select name="category_id" id="category_id"
                                            class="form-control form-select select2">
                                            <option value="">Select Category Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Product
                                            Name</label>
                                        <select name="product_id" id="product_id" class="form-control form-select select2">
                                            <option selected value="">Select Product Name</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                            <form method="POST" action="{{ route('purchase.store') }}">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered" width="100%"
                                        style="border-color
                                : #ddd;">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>PSC/KG</th>
                                                <th>Unit Price</th>
                                                <th>Description</th>
                                                <th>Total Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="addRow" class="addRow">

                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="5"></td>
                                                <td>
                                                    <input type="text" name="estimated_amount" id="estimated_amount"
                                                        class="form-control estimated_amount" style="background:#ddd;"
                                                        readonly value="0">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group mt-5">
                                    <button type="submit" class="btn btn-info" id="storeButton">Purchase Store</button>
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
            <input type="hidden" name="date[]" value="@{{ date }}">
            <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">

            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td width="10%">
                <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]"
                    value="">
            </td>
            <td width="10%">
                <input type="number" min="1" class="form-control unit_price text-right" name="unit_price[]"
                    value="">
            </td>
            <td>
                <input type="text" min="1" class="form-control" name="description[]">
            </td>
            <td>
                <input type="number" min="1" class="form-control buying_price text-right" name="buying_price[]"
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
                let purchase_no = $("#purchase_no").val();
                let supplier_id = $("#supplier_id").val();
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
                if (purchase_no == '') {
                    $.notify("Purchase no is required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }
                if (supplier_id == '') {
                    $.notify("Supplier is required", {
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
                    purchase_no: purchase_no,
                    supplier_id: supplier_id,
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


            $(document).on("keyup click", ".unit_price,.buying_qty", function() {
                let unit_price = $(this).closest("tr").find('input.unit_price').val();
                let buying_qty = $(this).closest("tr").find('input.buying_qty').val();
                let total = unit_price * buying_qty;
                $(this).closest("tr").find('input.buying_price').val(total);
                totalAmountPrice();
            });

            {{--  calculate sum amount for invoice  --}}

            function totalAmountPrice() {
                let sum = 0;
                $('.buying_price').each(function() {
                    let value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });
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

            $('#supplier_id').on('change', function() {
                let supplierId = $(this).val();
                console.log('supplier_id', supplierId);
                $.ajax({
                    url: '{{ route('get.category') }}?supplier_id=' + supplierId,
                    type: 'GET',
                    success: function(data) {
                        let html = '<option value="">Select Category </option>';
                        $.each(data, function(key, value) {
                            html += '<option value=" ' + value.category_id + ' "> ' +
                                value.category.name + '</option>';
                        });
                        $("#category_id").html(html);
                    }
                });
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
@endsection
