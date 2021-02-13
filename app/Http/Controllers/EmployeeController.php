<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFormRequest;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\Location;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['designations'] = Designation::all();
        $data['districts'] = Location::where('parent_id', '0')->orderBy('location_name', 'asc')->get();
        return view('employee', compact('data'));
    }

    public function store(EmployeeFormRequest $request)
    {
        $data = $request->validated();
        $result = Employee::updateOrInsert(['id' => $request->update_id], $data);
        if ($result) {
            $output = ['status' => 'success', 'message' => 'Data Has been Saved Successfully..'];
        }else{
            $output = ['status' => 'success', 'message' => 'Data Cannot Save Successfully'];
        }
        return response()->json($output);
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
