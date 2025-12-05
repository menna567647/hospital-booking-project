<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class DoctorSchedule extends Model
{
    protected $fillable =
    ["id", "doctor_id", "day", "start_time", "end_time"];

        public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    
    public function clients()
    {
        return $this->belongsToMany(
            Client::class,
            'appointments',
            'doctor_schedule_id',
            'client_id',
        )->withPivot(['id', 'is_booked'])->withTimestamps();
    }
 
}