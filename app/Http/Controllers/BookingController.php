<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function index(){
        $date_now = date("Y-m-d");
        $futureBookings = Booking::whereDate('booking_date', '>', $date_now)
            ->orderBy('booking_date', 'ASC')->orderBy('booking_time', 'ASC')
            ->get();

        $pastBookings = Booking::whereDate('booking_date', '<=', $date_now)
            ->orderBy('booking_date', 'DESC')->orderBy('booking_time', 'DESC')
            ->get();

        $bookings = $futureBookings->merge($pastBookings);


        $informations=[];
        foreach ($bookings as $booking) {
            $booking_id = $booking->id;
            $customer_name = Booking::find($booking_id)->getUser;
            $assigned_tables =$booking->getBookingtable()->orderBy('id')->get();
            $table_numbers = [];
            $table_seats = [];
            foreach($assigned_tables as $table){
                array_push($table_numbers,$table->table_number);
                array_push($table_seats,$table->seats);
            }
            $information = array(
                "booking_id" => $booking->id,
                "customer_name" => $customer_name->name,
                "table_numbers" => implode(',', $table_numbers),
                "total_seat" => array_sum($table_seats),
                "is_future_date" => $date_now < $booking->booking_date
            );
            array_push($informations,$information);
        }

        // echo json_encode($informations);
        return view('booking.index', ['bookings' => $bookings, 'informations'=>$informations]);
    }

    public function show(){
        $date_now = date("Y-m-d");
        $futureBookings = Booking::whereDate('booking_date', '>', $date_now)
            ->orderBy('booking_date', 'ASC')->orderBy('booking_time', 'ASC')
            ->get();

        $pastBookings = Booking::whereDate('booking_date', '<=', $date_now)
            ->orderBy('booking_date', 'DESC')->orderBy('booking_time', 'DESC')
            ->get();

        $bookings = $futureBookings->merge($pastBookings);
       
        // $bookings = Booking::orderBy('booking_date', 'ASC')->orderBy('booking_time', 'ASC')->get();
        $informations=[];
        
        foreach ($bookings as $booking) {
            $assigned_tables =$booking->getBookingtable()->orderBy('id')->get();
            $table_numbers = [];
            $table_seats = [];
            foreach($assigned_tables as $table){
                array_push($table_numbers,$table->table_number);
                array_push($table_seats,$table->seats);
            }
            $information = array(
                "booking_id" => $booking->id,
                "table_numbers" => implode(',', $table_numbers),
                "total_seat" => array_sum($table_seats),
                "is_future_date" => $date_now < $booking->booking_date
            );
            array_push($informations,$information);
        }
        return view('booking.show', ['bookings' => $bookings, 'informations'=>$informations]);
    }

    public function destroy(Booking $booking){
        $booking->getBookingtable()->detach();
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
        // $booking->booking_status = false;
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
        $booking->booking_status = "Pending";
        $booking->save();

        return redirect('/bookings/show');
    }

    public function updateStatus(Request $req, $id){
        $booking = Booking::findOrFail($id);

        $booking->booking_status = $req->status;
        $booking->save();

        return redirect('/bookings/index');
    }
}
