<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Booking;

class BookingController extends Controller
{
    public function create()
    {
        if (Gate::allows('isCustomer')) {
            dd('Customer allowed');
        } else {
            dd('You are not an Customer');
        }
    }

    public function edit()
    {
        if (Gate::allows('isCustomer')) {
            dd('Customer allowed');
        } else {
            dd('You are not an Customer');
        }
    }

    public function delete()
    {
        if (Gate::allows('isCustomer')) {
            dd('Customer allowed');
        } else {
            dd('You are not Customer');
        } 
    }
}
