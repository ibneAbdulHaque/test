<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public const VALIDATION_RULES = [
        'name' => ['required', 'string'],
        'user_name' => ['required', 'string', 'unique:employees, user_name'],
        'email' => ['required', 'email', 'unique:employees, email'],
        'mobile' => ['required', 'string', 'unique:employees, mobile'],
        'designation_id' => ['required', 'integer'],
        'address' => ['required', 'string'],
        'avatar' => ['nullable', 'image', 'mimes:jpg, png, jpeg, svg, webp'],
        'district_id' => ['required', 'integer'],
        'upazila_id' => ['required', 'integer'],
        'postal_code' => ['required', 'string'],
    ];
    protected $fillable = [
        'name',
        'user_name',
        'email',
        'mobile',
        'designation_id',
        'address',
        'avatar',
        'district_id',
        'upazila_id',
        'postal_code',
    ];
}
