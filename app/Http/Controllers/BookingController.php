<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index(){
        $bookings = Booking::all();
        return view('booking.index', ['bookings' => $bookings]);
    }

    public function show(){
        $bookings = Booking::all();
        return view('booking.show', ['bookings' => $bookings]);
    }

    public function destroy(Booking $booking){
        $booking->delete();
        return redirect('/bookings/show');
    }

    public function create(Request $req){
        $req->validate([
            'booking_date' => 'required | date | after:today',
            'booking_time' => 'required | before_or_equal:22:00 | after_or_equal:08:00',
            'contact_no' => ['required', 'regex:/^.*(?=.*\d{3}-\d{7,8}).*$/'],
            'no_of_person' => 'required | integer | between:1,8',
        ]);
        $booking = new Booking;
        $booking->user_id = Auth::id();
        $booking->booking_date = $req->booking_date;
        $booking->booking_time = $req->booking_time;
        $booking->contact_no = $req->contact_no;
        $booking->no_of_person = $req->no_of_person;
        $booking->isConfirmed = false;
        $booking->save();

        return redirect('/bookings/show');
    }

    public function showEdit($id){
        $booking = Booking::findOrFail($id);
        return view('booking.edit', ['booking'=>$booking]);
    }

    public function edit(Request $req){
        $req->validate([
            'booking_date' => 'required | date | after:today',
            'booking_time' => 'required | before_or_equal:22:00 | after_or_equal:08:00',
            'contact_no' => ['required', 'regex:/^.*(?=.*\d{3}-\d{7,8}).*$/'],
            'no_of_person' => 'required | integer | between:1,8',
        ]);
        $booking = Booking::find($req->id);
        $booking->booking_date = $req->booking_date;
        $booking->booking_time = $req->booking_time;
        $booking->contact_no = $req->contact_no;
        $booking->no_of_person = $req->no_of_person;
        $booking->isConfirmed = false;
        $booking->save();

        return redirect('/bookings/show');
    }

    public function updateStatus(Request $req, $id){
        $booking = Booking::findOrFail($id);
        $booking->isConfirmed = $req->status == 'Confirmed' ? true : false;
        $booking->save();

        return redirect('/bookings/index');
    }
}
