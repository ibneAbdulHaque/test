<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
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
