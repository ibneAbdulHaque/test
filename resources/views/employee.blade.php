@extends('layouts.app')
@push('style')
    <style>
        .required label:first-child::after{
            content: ' *';
            color: red;
            font-weight: bolder;
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
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Designation</th>
                                        <th>Address</th>
                                        <th>District</th>
                                        <th>Upazila</th>
                                        <th>Postal Code</th>
                                        <th>Verified Email</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Hasan</td>
                                        <td>Hasan234</td>
                                        <td>Hasan@gmail.com</td>
                                        <td>01516112076</td>
                                        <td>MD</td>
                                        <td>Mirpur</td>
                                        <td>Kurigram</td>
                                        <td>Ulipur</td>
                                        <td>5620</td>
                                        <td>Yes</td>
                                        <td>Actuve</td>
                                        <td><a href="#" class="btn btn-primary">Update</a></td>
                                    </tr>
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

    <script>
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

        function showModal(title, btnText){
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
                        console.log(data.status);
                        $('#exampleModal').modal('hide');
                    }
                },
                error: function(xhr, ajaxOption, thrownError){
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        }

    </script>
@endpush
