<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
       public function index($booking_id){
        $orderlist = Order::all();

        Session::put('booking_id', $booking_id);
        return view('order.index', ['orderlist' => $orderlist]);
    }

    public function destroy(Order $order){
        $message = "Your Order has been deleted";
        Session::flash('message_success',  $message); 

        $order->delete();

        $booking_id = Session::get('booking_id');
        return OrderController::index($booking_id);
    }

    public function create(Request $req){
        $req->validate([
            'dining_package' => 'required',
            'quantity' => 'required',
        ]);

        $booking_id = Session::get('booking_id'); 

        $order = new Order;
        $order->booking_id = $booking_id;
        $order->user_id = Auth::id();
        $order->dining_package = $req->dining_package;
        $order->quantity = $req->quantity;
        $order->save();

        $message = "Your Order has been added";
        Session::flash('message_success',  $message); 

        $booking_id = Session::get('booking_id');
        return OrderController::index($booking_id);
    }

    public function showEdit($id){
        $order = Order::findOrFail($id);
        $dining_packages = MenuController::getPackages();
        $menulist = MenuController::getMenu();
        return view('order.edit', ['order'=>$order, 'dining_packages' => $dining_packages, 'menulist' => $menulist]);
    }

    public function edit(Request $req){
        $req->validate([
            'dining_package' => 'required',
            'quantity' => 'required',
        ]);

        $booking_id = Session::get('booking_id');

        $order = Order::findOrFail($req->id);
        $order->booking_id =  $booking_id;
        $order->user_id = Auth::id();
        $order->dining_package = $req->dining_package;
        $order->quantity = $req->quantity;
        $order->save();

        $message = "Your Order has been updated";
        Session::flash('message_success',  $message); 

       
        return OrderController::index($booking_id);
    }

}
