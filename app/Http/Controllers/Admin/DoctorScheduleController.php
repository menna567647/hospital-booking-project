<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\http\Requests\Admin\DoctorScheduleRequest;

class DoctorScheduleController extends Controller
{
       public function __construct()
    {
        $this->middleware('can:read doctors schedules')->only(['index']);
        $this->middleware('can:create doctors schedules')->only(['create', 'store']);
        $this->middleware('can:update doctors schedules')->only(['edit', 'update']);
        $this->middleware('can:delete doctors schedules')->only(['destroy']);
    }

    public function index(Request $request)
    {
        $schedules = DoctorSchedule::with('doctor')
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->whereHas('doctor', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request->name . '%');
                });
            })
            ->paginate(10)
            ->appends($request->query());

            return view('admin.schedule.index', compact('schedules'));
    }

    public function createSchedule(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.schedule.create', compact('doctor'));
    }

    public function storeSchedule(DoctorScheduleRequest $request)
    {
        DoctorSchedule::create($request->validated());
        return redirect()->route('admin.schedules.index')->with("admin_message",  __("language.CREATEDSUCCESSFULLY"));
    }

    public function editSchedule(string $id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        return view('admin.schedule.edit', compact('schedule'));
    }

    public function updateSchedule(DoctorScheduleRequest $request, string $id)
    {
        $doctorschedule = DoctorSchedule::findOrFail($id);
        $doctorschedule->update($request->validated());
        return redirect()->route('admin.schedules.index')->with("admin_message",  __("language.UPDATEDSUCCESSFULLY"));
    }
}
