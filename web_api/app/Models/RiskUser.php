<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'monitor_place_id',
        'distance',
        'longitude',
        'latitude'
    ];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function monitor_places()
    {
        return $this->hasOne(MonitorPlace::class,'id','monitor_place_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

}
