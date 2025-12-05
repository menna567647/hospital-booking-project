<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use App\Models\DoctorSchedule;
use App\Models\Appointment;

class BookingController extends Controller
{

    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = Auth('api')->user();
        $clientBookings = $client->doctorschedules()->get();
        $clientBookingsCount = $client->doctorschedules()->count();
        $data = [
            'clientSchedules' => $clientBookings,
            'clientSchedulesCount' => $clientBookingsCount,
        ];
        if ($clientBookingsCount == 0) {
            return $this->apiSuccessMessage('No Bookings', []);
        }
        return $this->apiDataResponse($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bookAnAppointment(string $id)
    {
        
        $doctorScheduleId = DoctorSchedule::findOrFail($id)->id;
        $doctor_appointment_count = Appointment::where('doctor_schedule_id', $doctorScheduleId)->count();

        $client = Auth('api')->user();
        $clientAppointment = Appointment::where('client_id', $client->id)->where('doctor_schedule_id', $doctorScheduleId)->exists();
        if ($clientAppointment) {
            return $this->apiSuccessMessage('you already booked this schedule ', []);
        }
       
        if ($doctor_appointment_count == 3) {
            return $this->apiSuccessMessage('doctor has no appointments available', []);
        }
        $client->doctorschedules()->attach(
            $doctorScheduleId,
            ['is_booked' => 1]
        );

        return $this->apiSuccessMessage('your appointment booked successfully', []);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Appointment::findOrFail($id)->delete();
        return $this->apiSuccessMessage('your appointment deleted successfully', []);
    }

    /**
     * Remove all resources from storage.
     */
    public function deleteAll()
    {
        $client = Auth('api')->user();
        Appointment::where('client_id', $client->id)->delete();
        return $this->apiSuccessMessage('your appointments deleted successfully', []);
    }
}
