<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Booking;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    public function index(){
        $menulist = Menu::all();
        return view('menu.index', ['menulist' => $menulist]);
    }

    public function destroy(Menu $menu){
        $menu->delete();
        return redirect('/menu/index');
    }

    public function create(Request $req){
        $req->validate([
            'dining_package' => 'required',
            'items' => 'required',
            'description' => 'required',
        ]);
        $menu = new Menu;
        $menu->dining_package = $req->dining_package;
        $menu->items = $req->items;
        $menu->description = $req->description;
        $menu->save();

        return redirect('/menu/index');
    }

    public function showEdit($id){
        $menu = Menu::findOrFail($id);
        return view('menu.edit', ['menu'=>$menu]);
    }

    public function edit(Request $req){
        $req->validate([
            'dining_package' => 'required',
            'items' => 'required',
            'description' => 'required',
        ]);
        $menu = Menu::findOrFail($req->id);
        $menu->dining_package = $req->dining_package;
        $menu->items = $req->items;
        $menu->description = $req->description;
        $menu->save();

        return redirect('/menu/index');
    }

    public function showOrder($id){
        $selected_booking = Booking::findOrFail($id);
        $date_now = date("Y-m-d");
        $is_future_date = $date_now < $selected_booking->booking_date;
        $menulist = Menu::all(); 
        $booking_menu = $selected_booking->getMenu()->orderBy('booking_id')->get();
            
        return view('menu.showOrder', ['selected_booking'=>$selected_booking, 'menulist'=>$menulist,'booking_menu'=>$booking_menu,'is_future_date'=>$is_future_date]);
    }

    public function showCreateOrder($id){
        $selected_booking = Booking::findOrFail($id);
        $menulist = Menu::all(); 
        $booking_menu = $selected_booking->getMenu()->orderBy('booking_id')->get();
       
        return view('menu.createOrder', ['booking'=>$selected_booking, 'menulist'=>$menulist,'booking_menu'=>$booking_menu]);
    }

    public function createOrder(Request $req){
        $req->validate([
            'quantity' => 'required | integer | gt:0',
        ]);
        $booking_id = $req->booking_id;

        $booking = Booking::findOrFail($booking_id);
        $menu_id = $req->menu_id;
        $quantity = $req->quantity;
        $booking->getMenu()->detach([['menu_id' => $menu_id]]);
        $booking->getMenu()->attach([['menu_id'=>$menu_id,'quantity'=>$quantity]]);

        $customer_name = Booking::find($booking_id)->getUser->name;
        $booking_date = $booking->booking_date;
        $booking_time = $booking->booking_time;

        $message = "Added Order to $customer_name booking with id $booking_id on $booking_date at $booking_time";
        Session::flash('message_success',  $message); 
        return MenuController::showOrder($booking_id);
    }

    public function destroyOrder($booking_id,$menu_id){
        $booking = Booking::findOrFail($booking_id);
        $booking->getMenu()->detach(['booking_id' => $booking_id, 'menu_id' => $menu_id]);

        $message = "Your Order has been deleted";
        Session::flash('message_success',  $message); 
        return MenuController::showOrder($booking_id);
    }

    public function showEditOrder($booking_id,$menu_id){
        $selected_booking = Booking::findOrFail($booking_id);
        $menulist = Menu::all(); 
        $booking_menu = $selected_booking->getMenu()->orderBy('booking_id')->get();
       
        return view('menu.editOrder', ['booking'=>$selected_booking,'menulist'=>$menulist, 'booking_menu'=>$booking_menu, 'menu_id'=>$menu_id]);
    }

    public function editOrder(Request $req){
        $req->validate([
            'quantity' => 'required | integer | gt:0',
        ]);
        $booking_id = $req->booking_id;

        $booking = Booking::findOrFail($booking_id);
        $old_menu_id = $req->old_menu_id;
        $menu_id = $req->menu_id;
        $quantity = $req->quantity;
        $booking->getMenu()->detach([['menu_id' => $old_menu_id]]);
        $booking->getMenu()->attach([['menu_id'=>$menu_id,'quantity'=>$quantity]]);

        $customer_name = Booking::find($booking_id)->getUser->name;
        $booking_date = $booking->booking_date;
        $booking_time = $booking->booking_time;

        $message = "Edit the Order to $customer_name booking with id $booking_id on $booking_date at $booking_time";
        Session::flash('message_success',  $message); 
        return MenuController::showOrder($booking_id);
    }

}
