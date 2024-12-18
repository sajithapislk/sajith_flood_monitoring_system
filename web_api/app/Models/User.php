<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'guardian_name',
        'email',
        'password',
        'tp',
        'guardian_tp',
        'area_id',
        'risk_alert'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tp_verified_at' => 'datetime',
    ];
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    public function monitorPlaces()
    {
        return $this->hasMany(MonitorPlace::class, 'area_id', 'area_id');
    }
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }
    public function scopeUnreadNotifications(Builder $query)
    {
        return $query->whereNull('read_at');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
