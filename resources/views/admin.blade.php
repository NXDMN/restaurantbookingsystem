@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <a href="bookings/index" class="btn btn-primary btn-lg">
                        Bookings
                    </a>
                    <a href="bookingtables/index" class="btn btn-primary btn-lg">
                        Booking Tables
                    </a>
                    <a href="menu/index" class="btn btn-primary btn-lg">
                        Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection