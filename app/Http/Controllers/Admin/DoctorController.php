<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\http\Requests\Admin\DoctorRequest;
use Illuminate\Support\Facades\File;

class DoctorController extends Controller
{
     public function __construct()
    {
        $this->middleware('can:read doctors')->only(['index']);
        $this->middleware('can:create doctors')->only(['create', 'store']);
        $this->middleware('can:update doctors')->only(['edit', 'update']);
        $this->middleware('can:delete doctors')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctors = Doctor::query()
            ->when($request->filled('name'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->paginate(10)
            ->appends($request->query());

        $totalDoctors = $doctors->total();

        return view('admin.doctor.index', compact(
            'doctors',
            'totalDoctors'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('admin.doctor.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        if ($request->hasFile("images")) {
            $image = $request->images;
            $folder = date('Y/m/d');
            $imageName = time() . rand(1, 100) . "." . $image->extension();
            $image->move(public_path('build/assets/img/doctors/' . $folder), $imageName);

            $imagePath = 'build/assets/img/doctors/' . $folder . '/' . $imageName;
        } else {
            $imagePath = null;
        }

        Doctor::create(array_merge($request->validated(), ['images' => $imagePath]));

        return redirect()->route('admin.doctors.index')->with("admin_message", __("language.CREATEDSUCCESSFULLY"));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $departments = Department::all();
        return view('admin.doctor.edit', compact('doctor', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);

        if ($request->hasFile("images")) {
            File::delete($doctor->images);
            $image = $request->images;
            $folder = date('Y/m/d');
            $imageName = time() . rand(1, 100) . "." . $image->extension();
            $image->move(public_path('build/assets/img/doctors/' . $folder), $imageName);

            $imagePath = 'build/assets/img/doctors/' . $folder . '/' . $imageName;
        } else {
            $imagePath = $doctor->images;
        }

        $doctor->update(array_merge($request->validated(), ['images' => $imagePath]));

        return redirect()->route('admin.doctors.index')->with("admin_message",  __("language.UPDATEDSUCCESSFULLY"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $imagePath = $doctor->images;
        $doctor->delete();
        if (!empty($imagePath)) {
            File::delete($imagePath);
        }
        return redirect()->route('admin.doctors.index')->with("admin_message",  __("language.DELETEDSUCCESSFULLY"));
    }
}
