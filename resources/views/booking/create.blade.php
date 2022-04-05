@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Bookings</div>
                <div class="card-body">
                    <form method="POST" action='/bookings/create'>
                        @csrf
                        <div class="mb-3">
                            <label for="booking_date" class="form-label">Booking Date</label>
                            <input 
                            type="date" 
                            class="form-control @error('booking_date') is-invalid @enderror" 
                            id="booking_date" 
                            name="booking_date">
                            @error('booking_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="booking_time" class="form-label">Booking Time</label>
                            <input
                            type="time" 
                            class="form-control @error('booking_time') is-invalid @enderror" 
                            id="booking_time"
                            name="booking_time">
                            @error('booking_time')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_no" class="form-label">Contact Number</label>
                            <input
                            type="tel" 
                            class="form-control @error('contact_no') is-invalid @enderror" 
                            id="contact_no"
                            name="contact_no">
                            @error('contact_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_of_person" class="form-label">Number of Person</label>
                            <input
                            type="tel" 
                            class="form-control @error('no_of_person') is-invalid @enderror" 
                            id="no_of_person"
                            name="no_of_person">
                            @error('no_of_person')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection