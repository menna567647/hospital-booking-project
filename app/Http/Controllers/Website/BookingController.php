<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();
        return view('website.appointments.index', compact('doctors'));
    }

    public function clientBooking()
    {
        $client = Auth::user();
        $client_booking = $client->doctorschedules()->get();
        $client_booking_count = $client->doctorschedules()->count();
        return view('website.appointments.mybooking', compact('client', 'client_booking_count', 'client_booking'));
    }


    public function bookAppointment($id)
    {
        $doctor_schedule_id = DoctorSchedule::findOrFail($id)->id;

        $doctor_appointment_count = Appointment::where('doctor_schedule_id', $doctor_schedule_id)->count();

        if ($doctor_appointment_count >= 3) {
            return redirect()->route('website.bookings.index')
                ->with("book_message", "Doctor has no booking available");
        }

        $client = Auth::user();

        $alreadyBooked = Appointment::where('client_id', $client->id)
            ->where('doctor_schedule_id', $doctor_schedule_id)
            ->exists();

        if ($alreadyBooked) {
            return redirect()->route('website.bookings.index')
                ->with("book_message", "You already booked this appointment");
        }

        $client->doctorschedules()->attach(
            $doctor_schedule_id,
            ['is_booked' => 1]
        );

        return redirect()->route('website.bookings.index')
            ->with("book_message", "Booked Successfully");
    }


    public function delete($id)
    {
        $client_booking = Appointment::findOrFail($id);
        $client_booking->delete();
        return redirect()->route('website.bookings.show')->with("show_book_message", "deleted successfully");
    }

    public function deleteAll()
    {
        $client = Auth('client')->user();
        Appointment::where('client_id', $client->id)->delete();
        return redirect()->route('website.bookings.show')->with("show_book_message", "All your booking is deleted successfully");
    }
}
