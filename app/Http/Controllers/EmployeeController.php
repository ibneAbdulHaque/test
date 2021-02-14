<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFormRequest;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Location;
use App\Traits\Uploadable;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    use Uploadable;
    public function index()
    {
        $data['designations'] = Designation::all();
        $data['districts'] = Location::where('parent_id', '0')->orderBy('location_name', 'asc')->get();
        return view('employee', compact('data'));
    }

    public function store(EmployeeFormRequest $request)
    {
        $data = $request->validated();
        $collection = collect($data)->except('avatar');
        if ($request->file('avatar')) {
            $avatar = $this->upload_file($request->file('avatar'));
            $collection = $collection->merge(compact('avatar'));
        }

        $result = Employee::updateOrCreate(['id' => $request->update_id], $collection->all());
        if ($result) {
            $output = ['status' => 'success', 'message' => 'Data Has been Saved Successfully..'];
        }else{
            $output = ['status' => 'success', 'message' => 'Data Cannot Save Successfully'];
        }
        return response()->json($output);
    }

    public function employee_list(Request $request)
    {
        if ($request->ajax()) {
            $employee = new Employee();

            
            $employee->setOrderValue($request->input('order.0.column'));
            $employee->setDirValue($request->input('order.0.dir'));
            $employee->setLengthValue($request->input('length'));
            $employee->setStartValue($request->input('start'));

            $list = $employee->getList();

            $data = [];
            $no = $request->input('start');
            foreach ($list as $value) {
                $no++;
                $action = '';
                $action .= ' <a class="dropdown-item edit_data" data-id="' . $value->id . '"><i class="fas fa-edit text-primary"></i> Edit</a>';
                $action .= ' <a class="dropdown-item view_data"  data-id="' . $value->id . '"><i class="fas fa-eye text-warning"></i> View</a>';
                $action .= ' <a class="dropdown-item delete_data"  data-id="' . $value->id . '" data-name="' . $value->name . '"><i class="fas fa-trash text-danger"></i> Delete</a>';

                $btngroup = '<div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-th-list"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                ' . $action . '
                </div>
              </div>';

                $row = [];
                $row[] = $no;
                $row[] = $value->name;
                $row[] = $this->avatar($value->avatar, $value->name);
                $row[] = $value->user_name;
                $row[] = $value->email;
                $row[] = $value->mobile;
                $row[] = $value->designation->designation_name;
                $row[] = $value->address;
                $row[] = $value->district->location_name;
                $row[] = $value->upazila->location_name;
                $row[] = $value->postal_code;
                $row[] = $value->status;
                $row[] = $btngroup;
                $data[] = $row;
            }
            $output = array(
                "draw" => $request->input('draw'),
                "recordsTotal" => $employee->count_all(),
                "recordsFiltered" => $employee->count_filtered(),
                "data" => $data,
            );

            echo json_encode($output);
        }
    }

    
    private function avatar($avatar = null, $name)
    {
        return !empty($avatar) ? '<img src="' . asset("storage/". $avatar) . '" alt="' . $name . '" style="width:60px;"/>' : '<img style="width:60px;" src="' . asset("svg/user.svg") . '" alt="User Avatar"/>';
    }


    public function upazilaList(Request $request)
    {
        if ($request->ajax()) {
            if ($request->district_id) {
                $output = '<option value="">Please Choose Upazila</option>';
                $upazilas = Location::where('parent_id', $request->district_id)->orderBy('location_name', 'asc')->get();
                if (!$upazilas->isEmpty()) {
                    foreach ($upazilas as $value) {
                        $output .= '<option value="'.$value->id.'">'.$value->location_name.'</option>';
                    }
                }
                return response()->json($output);
            }
            
            
        }
    }
}
