<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Bookingtable;
use App\Models\Booking;

class BookingtableController extends Controller
{
    public function index(){
        $bookingtables = Bookingtable::all();
        return view('bookingtable.index', ['bookingtables' => $bookingtables]);
    }

    public function destroy(Bookingtable $bookingtable){
        $bookingtable->delete();
        return redirect('/bookingtables/index');
    }

    public function create(Request $req){
        $req->validate([
            'table_number' => 'required',
            'seats' => 'required | integer | between:1,8',
        ]);
        $bookingtable = new Bookingtable;
        // $bookingtable->booking_id = $req->booking_id;
        $bookingtable->table_number = $req->table_number;
        $bookingtable->seats = $req->seats;
        $bookingtable->save();

        return redirect('/bookingtables/index');
    }

    public function showEdit($id){
        $bookingtable = Bookingtable::findOrFail($id);
        return view('bookingtable.edit', ['bookingtable'=>$bookingtable]);
    }

    public function edit(Request $req){
        $req->validate([
            'table_number' => 'required',
            'seats' => 'required | integer | between:1,8',
        ]);
        $bookingtable = Bookingtable::findOrFail($req->id);
        $bookingtable->table_number = $req->table_number;
        $bookingtable->seats = $req->seats;
        $bookingtable->save();

        return redirect('/bookingtables/index');
    }

    public function showAssign($id){
        $selected_booking = Booking::findOrFail($id);
        $selected_booking_date = $selected_booking->booking_date;
        $selected_booking_time = $selected_booking->booking_time;

        $bookingtables = Bookingtable::all();
        $newbookingtables = [];
        $booking_inforamtion = NULL;
        foreach ($bookingtables as $table) {
            $all_bookings = $table->getBooking()->orderBy('id')->get();
            $is_assign_to_self = false;
            $is_assign_to_other = false;
            // $booking_informations = [];
            foreach($all_bookings as $booking){
                if ($selected_booking_date == $booking->booking_date) {
                    $interval = abs((strtotime($selected_booking_time)-strtotime($booking->booking_time))/60);

                    if($id == $booking->id){
                        $is_assign_to_self = true;
                        $booking_inforamtion = array(
                            "booking_id" => $booking->id,
                            "booking_time" => $booking->booking_time,
                        );
                    }
                    elseif($interval<60){
                        $is_assign_to_other = true;
                        $booking_inforamtion = array(
                            "booking_id" => $booking->id,
                            "booking_time" => $booking->booking_time,
                        );
                    }
                }  
            }
            $newbookingtable = array(
                "id" => $table->id,
                "table_number"=>$table->table_number,
                "seats"=>$table->seats,
                "booking_informations" => $booking_inforamtion,
                "is_assign_to_self"=> $is_assign_to_self,
                "is_assign_to_other"=> $is_assign_to_other
            );
            array_push($newbookingtables,$newbookingtable);
        }
        return  view('bookingtable.assign', ['booking'=>$selected_booking, 'bookingtables'=>$newbookingtables]);
    }

    public function assign(Request $req){
        $booking_id = $req->booking_id;

        $booking = Booking::findOrFail($booking_id);
        $tables = $req->selected_table;
        $booking->getBookingtable()->detach();
        $booking->getBookingtable()->attach($tables);

        $customer_name = Booking::find($booking_id)->getUser->name;
        $table_count = count($tables);
        $booking_date = $booking->booking_date;
        $booking_time = $booking->booking_time;
        $message = "Added $table_count table to $customer_name booking with id $booking_id on $booking_date at $booking_time";
        Session::flash('message_success',  $message); 
        return redirect('/bookings/index');
    }
}
