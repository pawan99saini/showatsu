<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Modal extends Model
{
    use HasFactory,SoftDeletes;
    protected $hidden = ['created_at', 'updated_at','deleted_at'];


    protected $fillable = [

        'make_id',
        'name',
        'status'
    ];
}
