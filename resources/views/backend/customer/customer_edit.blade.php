@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Customer Add Page </h4><br><br>


                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dismissible fade show"> {{ $error }} </p>
                                @endforeach
                            @endif


                            <form method="post" action="{{ route('customer.update') }}" id="myForm"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" id="id" value="{{ $customerInfo->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="name" class="form-control" type="text" id="name"
                                            value="{{ $customerInfo->name }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="email" class="form-control" type="email" id="email"
                                            value="{{ $customerInfo->email }}">
                                    </div>
                                </div>
                                <!-- end row -->


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="mobile_no" class="form-control" type="tel" id="mobile_no"
                                            value="{{ $customerInfo->mobile_no }}">
                                    </div>
                                </div>
                                <!-- end row -->



                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Address</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="address" class="form-control" type="text" id="address"
                                            value="{{ $customerInfo->address }}">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Customer Image</label>
                                    <div class="col-sm-10 form-group">
                                        <input name="image" class="form-control" type="file" id="image">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10 form-group">
                                        <img class="img-profile" width="100"
                                            src="{{ !empty($customerInfo->customer_image) ? url($customerInfo->customer_image) : url('upload/no_image.jpg') }}"
                                            id="show_image" alt="Profile Image">
                                    </div>
                                </div>
                                <!-- end row -->


                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Customer">
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
                    name: {
                        required: true,
                    },
                    mobile_no: {
                        required: true,
                    },
                    email: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                },
                message: {
                    name: {
                        required: "Please Enter your name",
                    },
                    email: {
                        required: "Please Enter your email address",
                    },
                    mobile_no: {
                        required: "Please Enter your mobile number",
                    },
                    address: {
                        required: "Please Enter your address",
                    },
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show_image').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
