<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'safety_place_id',
        'risk_user_id'
    ];
    public function risk_user()
    {
        return $this->hasOne(RiskUser::class,'id','risk_user_id');
    }
    public function safety_place()
    {
        return $this->hasOne(SafetyPlace::class,'id','safety_place_id');
    }
}
