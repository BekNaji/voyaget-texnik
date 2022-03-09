<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GosNumber extends Model
{
    use HasFactory;
    protected $table = 'gos_number';
    protected $guarded = ['id'];


    public function setNumberAttribute($value)
    {
        return $this->attributes['number'] = strtoupper($value);
    }
}
