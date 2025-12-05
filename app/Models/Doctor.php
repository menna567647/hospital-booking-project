<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;


class Doctor extends Model
{
    protected $fillable =
    ["id", "images", "name", "department_id", "phone", "consultancy_fees"];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

         public function doctorschedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

}
