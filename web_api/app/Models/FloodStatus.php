<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloodStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitor_place_id',
        'water_level',
    ];

    public function monitor_place()
    {
        return $this->hasOne(MonitorPlace::class,'id','monitor_place_id');
    }
}
