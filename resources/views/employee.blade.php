@extends('layouts.app')

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
        function showModal(title, btnText){
            $('#exampleModal').modal();
            $('#exampleModal #modaltitle').text(title);
            $('#exampleModal #modalbtntext').text(btnText);
        }
    </script>
@endpush
