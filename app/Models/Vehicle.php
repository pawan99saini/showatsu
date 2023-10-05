<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Vehicle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = ['created_at', 'updated_at','deleted_at'];

    protected $fillable = [

        'name',
        'make',
        'image',
        'model',
        'grade',
        'fuel_type',
        'exterior_color',
        'interior_color',
        'engine',
        'transmission',
        'year',
        'price',
        'wheel_style',
        'chassis_no',
        'interior_type',
        'kilometers',
        'drive',
        'accessories',
        'comments',
        'status'
    ];

    public function gallary()
    {
        return $this->hasMany(VehicleGallary::class);
    }
    
    public function vehicle_name()
    {
        return $this->belongsTo(VehicleName::class,'name','id');
    }
    
    public function make_info()
    {
        return $this->belongsTo(Make::class,'make','id');
    }
    
    public function model_info()
    {
        return $this->belongsTo(Modal::class,'model','id');
    }
    
    public function fuel_info()
    {
        return $this->belongsTo(FuelType::class,'fuel_type','id');
    }
    
    public function engine_info()
    {
        return $this->belongsTo(Engine::class,'engine','id');
    }
    
    public function transmission_info()
    {
        return $this->belongsTo(Transmission::class,'transmission','id');
    }
    
    public function exterior_color_info()
    {
        return $this->belongsTo(ExteriorColor::class,'exterior_color','id');
    }
    
    public function interior_color_info()
    {
        return $this->belongsTo(InteriorColor::class,'interior_color','id');
    }
    
    public function interior_type_info()
    {
        return $this->belongsTo(InteriorType::class,'interior_type','id');
    }

    
}


