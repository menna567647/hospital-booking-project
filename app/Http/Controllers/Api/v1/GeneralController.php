<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\DoctorSchedule;
use App\Models\Department;
use App\Http\Resources\DoctorScheduleResource;
use App\Http\Resources\DepartmentResource;

class GeneralController extends Controller
{
    use ApiResponse;

    public function doctorSchedules()
    {
        $doctorSchedule = DoctorScheduleResource::collection(DoctorSchedule::all());
        $data = [
            'doctorSchedule' => $doctorSchedule
        ];

        return $this->apiDataResponse($data);
    }


    public function departments()
    {

        $departments = DepartmentResource::collection(Department::all());

        $data = [
            'departments' => $departments
        ];

        return $this->apiDataResponse($data);
    }
}
