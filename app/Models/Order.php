<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [

        'vehicle_id',
        'name',
        'address',
        'city',
        'state',
        'country',
        'zip',
        'email',
        'work_phone',
        'home_phone',
        'cellular_phone',
        'fax',
        'consignee_name',
        'consignee_address',
        'consignee_city',
        'consignee_state',
        'consignee_country',
        'consignee_zip',
        'consignee_email',
        'consignee_work_phone',
        'consignee_home_phone',
        'consignee_fax',
        'permit_no',
        'payment_mode',
        'destination_port',
        'destination_country',
        'status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
}


