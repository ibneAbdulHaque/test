<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" id="storeForm">
                @csrf
                <input type="hidden" name="update_id" id="update_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <span class="text-danger">All (*) Mark fields are required.</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <x-textbox labelName="Name" name="name" required="required" col="col-md-12" placeholder="Enter Employee Name" />
                                <x-textbox labelName="User Name" name="user_name" required="required" col="col-md-12" placeholder="Enter Employee User Name" />
                                <x-textbox labelName="Email" type="email" name="email" required="required" col="col-md-12" placeholder="Enter Employee Email" />
                                <x-textbox labelName="Mobile" name="mobile" required="required" col="col-md-12" placeholder="Enter Employee Contact Number" />

                                <x-textarea labelName="Address" name="address" required="required" col="col-md-12" placeholder="Enter Employee Address" rows="6" />
                                <x-selectbox labelName="District" onchange="upazilaList(this.value)" name="district_id" required="required" col="col-md-12" >
                                    @if (!$data['districts']->isEmpty())
                                        @foreach ($data['districts'] as $district)
                                            <option value="{{ $district->id }}">{{ $district->location_name }}</option>
                                        @endforeach
                                    @endif
                                </x-selectbox>
                                <x-selectbox labelName="Upazila" name="upazila_id" required="required" col="col-md-12" > 

                                </x-selectbox>
                                <x-textbox labelName="Postal Code" name="postal_code" required="required" col="col-md-12" placeholder="Enter Postal Code" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <x-selectbox labelName="Designation" name="designation_id" required="required" col="col-md-12">
                                    @if (!$data['designations']->isEmpty())
                                        @foreach ($data['designations'] as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                        @endforeach
                                    @endif
                                    
                                </x-selectbox>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="modalbtntext">Save changes</button>
            </div>
        </div>
    </div>
</div>
