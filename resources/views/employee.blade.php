@extends('layouts.app')
@push('style')
    <link rel="stylesheet" href="{{ asset('css/datatable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/dropify.min.css') }}">

    <script src="https://kit.fontawesome.com/4623bd79b6.js" crossorigin="anonymous"></script>
    <style>
        .required label:first-child::after{
            content: ' *';
            color: red;
            font-weight: bolder;
        }   
        .dropify-wrapper .dropify-message p {
            margin: 5px 0 0;
            font-size: 14px;
        } 
    </style>    
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employee Data <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal" onclick="showModal('Title', 'Add Employee')">
                    Add
                  </button>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Avatar</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Designation</th>
                                        <th>Address</th>
                                        <th>District</th>
                                        <th>Upazila</th>
                                        <th>Postal Code</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>        
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals.modal');
@endsection

@push('script')
    <script src="{{ asset('js/datatable.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script>
        var table;
        $(document).ready(function (){
            table = $('#dataTable').DataTable({
                "processing": true, //Feature control the processing indicator
                "serverSide": true, //Feature control DataTable server side processing mode
                "order": [], //Initial no order
                "responsive": true, //Make table responsive in mobile device
                "bInfo": true, //TO show the total number of data
                "bFilter": false, //For datatable default search box show/hide
                "lengthMenu": [
                    [5, 10, 15, 25, 50, 100, 500, 1000, 10000, -1],
                    [5, 10, 15, 25, 50, 100, 500, 1000, 10000, "All"]
                ],
                "pageLength": 5, //number of data show per page
                "language": {
                    processing: `<img src="{{asset('svg/table-loading.svg')}}" alt="Loading...."/>`,
                    emptyTable: '<strong class="text-danger">No Data Found</strong>',
                    infoEmpty: '',
                    zeroRecords: '<strong class="text-danger">No Data Found</strong>'
                },
                "ajax": {
                    "url": "{{route('employee.list')}}",
                    "type": "POST",
                    "data": function (data) {
                        data._token = _token;
                    }
                },
            });

        });

        $('.dropify').dropify();
        function upazilaList(district_id){
            // alert(district_id);
            // alert(_token);
            if (district_id) {
                $.ajax({
                    url: "{{ route('employee.upazila.list') }}",
                    type: "post",
                    data: {district_id: district_id, _token: _token},
                    dataType: "json",
                    success: function(data){
                        $('#upazila_id').html('');
                        $('#upazila_id').html(data);
                    },
                    error: function(xhr, ajaxOption, thrownError){
                        console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                    }

                });
            }
        }
    </script>
    <script>
    // flashMessage('success', 'Thanks for Using Me');
        function showModal(title, btnText){
            $('#storeForm')[0].reset();
            $('#storeForm').find('.is-invalid').removeClass('is-invalid');
            $('#storeForm').find('.error').remove();
            $('#storeForm .dropify-render img').attr('src', '');
            // $('#storeForm .dropify-infos .dropify-filename').remove();
            // $('#storeForm .dropify-preview').remove();
            $('#exampleModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('#exampleModal #modaltitle').text(title);
            $('#exampleModal #modalbtntext').text(btnText);
        }

        $(document).on('click', '#modalbtntext', function(){
            
            let storeForm = document.getElementById('storeForm');
            let formData = new FormData(storeForm);
            store_form_data(formData);
        });

        function store_form_data(formData){
            $.ajax({
                url: "{{ route('employee.store') }}",
                type: "post",
                data: formData, 
                dataType: "json",
                contentType: false,
                processData: false,
                cache:false,
                success: function(data){
                    $('#storeForm').find('.is-invalid').removeClass('is-invalid');
                    $('#storeForm').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function(key, value){
                            $('#storeForm #'+key).addClass('is-invalid');
                            $('#storeForm #'+key).parent().append('<div class="error invalid-tooltip">'+value+'</div>');
                        });   
                    }else{
                        flashMessage(data.status, data.message);
                        $('#exampleModal').modal('hide');
                    }
                },
                error: function(xhr, ajaxOption, thrownError){
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        }

        function flashMessage(status, message){
            
            toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            };
            switch (status) {
                case "success":
                toastr["success"](message, "SUCCESS")
                    break;
                case "error":
                toastr["error"](message, "ERROR")
                    break;
                case "info":
                toastr["info"](message, "INFO")
                    break;
                case "warning":
                toastr["warning"](message, "WARNING")
                    break;
            };
            
        }

    </script>
@endpush
