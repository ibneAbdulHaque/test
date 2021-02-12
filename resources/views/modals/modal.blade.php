<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaltitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <x-textbox labelName="Name" name="name" required="required" col="col-md-12" placeholder="Enter Employee Name" />
                        <x-textbox labelName="User Name" name="username" required="required" col="col-md-12" placeholder="Enter Employee User Name" />
                        <x-textbox labelName="Email" type="email" name="email" required="required" col="col-md-12" placeholder="Enter Employee Email" />
                        <x-textbox labelName="Mobile" name="mobile" required="required" col="col-md-12" placeholder="Enter Employee Contact Number" />
                        <x-textbox labelName="Designation" name="designation" required="required" col="col-md-12" placeholder="Enter Employee Designation" />
                        <x-textarea labelName="Address" name="address" required="required" col="col-md-12" placeholder="Enter Employee Address" rows="6" />
                        <x-selectbox labelName="District" name="district" required="required" col="col-md-12" />
                        <x-selectbox labelName="Upazila" name="upazila" required="required" col="col-md-12" />
                        <x-textbox labelName="Postal Code" name="postal_code" required="required" col="col-md-12" placeholder="Enter Postal Code" />
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
