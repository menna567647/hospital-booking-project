<?php

namespace App\Models;
use App\Models\Doctor;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable= 
    ["id","name"];

     public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

}