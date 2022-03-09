<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function setFullNameAttribute($value)
    {
        return $this->attributes['full_name'] = strtoupper($value);
    }

    public function region()
    {
        return $this->hasOne(\App\Models\Region::class,'id','region_id');
    }

    public function district()
    {
        return $this->hasOne(\App\Models\District::class,'id','district_id');
    }
}
