<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ClientResetPasswordNotification;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable implements CanResetPasswordContract
{
    use CanResetPasswordTrait, Notifiable, HasApiTokens;

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }

    protected $fillable = [
        'id',
        'name',
        'phone',
        'password',
        'email',
        'age',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function doctorschedules()
    {
        return $this->belongsToMany(
            DoctorSchedule::class,
            'appointments',
            'client_id',
            'doctor_schedule_id',
        )->withPivot(['id', 'is_booked'])->withTimestamps();
    }
}
