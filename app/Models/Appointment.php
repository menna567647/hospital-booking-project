<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    protected $fillable =
    ["id", "client_id", "doctor_schedule_id", "is_booked"];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function doctorSchedule()
    {
        return $this->belongsTo(DoctorSchedule::class, 'doctor_schedule_id');
    }
}
