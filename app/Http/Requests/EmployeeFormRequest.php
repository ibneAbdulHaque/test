<?php

namespace App\Http\Requests;

use App\Models\Employee;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmployeeFormRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 200)
        );
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Employee::VALIDATION_RULES;
        if (request()->update_id) {
            $rules['user_name'][2] = 'unique:employees, user_name, '.request()->update_id;
            $rules['email'][2] = 'unique:employees,email, '.request()->update_id;
            $rules['mobile'][2] = 'unique:employees,mobile, '.request()->update_id; 
        }
        return $rules;
        
    }
}
