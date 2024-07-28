<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitorPlace extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'is_danger',
        'd_level',
        'longitude',
        'latitude',
        'name',
    ];
    public function area()
    {
        return $this->hasOne(Area::class,'id','area_id');
    }
}
