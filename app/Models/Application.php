<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'application';
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->hasOne(\App\Models\Customer::class,'id','customer_id');
    }

    public function carBrand()
    {
        return $this->hasOne(\App\Models\CarBrand::class,'id','car_brand_id');
    }

    public function carColor()
    {
        return $this->hasOne(\App\Models\CarColor::class,'id','car_color_id');
    }

    public function gosNumber()
    {
        return $this->hasOne(\App\Models\GosNumber::class,'id','gos_number_id');
    }

    
}
