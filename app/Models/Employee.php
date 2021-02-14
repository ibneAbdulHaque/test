<?php

namespace App\Models;

use App\Models\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    public const VALIDATION_RULES = [
        'name' => ['required', 'string'],
        'user_name' => ['required', 'string', 'unique:employees,user_name'],
        'email' => ['required', 'email', 'unique:employees,email'],
        'mobile' => ['required', 'string', 'unique:employees,mobile'],
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

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function district()
    {
        return $this->belongsTo(Location::class, 'district_id', 'id');
    }
    public function upazila()
    {
        return $this->belongsTo(Location::class, 'upazila_id', 'id');
    }

    private $order = array('employees.id' => 'desc');
    private $column_order;

    
    private $orderValue;
    private $dirValue;
    private $startVlaue;
    private $lengthVlaue;

    public function setOrderValue($orderValue)
    {
        $this->orderValue = $orderValue;
    }
    public function setDirValue($dirValue)
    {
        $this->dirValue = $dirValue;
    }
    public function setStartValue($startVlaue)
    {
        $this->startVlaue = $startVlaue;
    }
    public function setLengthValue($lengthVlaue)
    {
        $this->lengthVlaue = $lengthVlaue;
    }

    private function get_datatable_query()
    {
        $query = self::with(['designation:id,designation_name', 'district:id,location_name', 'upazila:id,location_name']);
        return $query;
    }

    public function getList()
    {
        $query = $this->get_datatable_query();
        if ($this->lengthVlaue != -1) {
            $query->offset($this->startVlaue)->limit($this->lengthVlaue);
        }
        return $query->get();
    }

    public function count_filtered()
    {
        $query = $this->get_datatable_query();
        return $query->get()->count();
    }

    public function count_all()
    {
        return self::toBase()->get()->count();
    }








}
