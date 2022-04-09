@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Booking Table for Bookings id {{$booking['id']}} - require
                    ({{$booking['no_of_person']}}pax) at {{$booking['booking_time']}} <br>*The table must have 1 hour time to be assigned</div>
                <div class="card-body">
                    <form method="POST" action='/bookingtables/assign'>
                        @csrf
                        <input type="hidden" name="booking_id" value="{{$booking['id']}}" />
                        @foreach($bookingtables as $bookingtable)
                        <div class="form-check">
                            <input class="form-check-input" name="selected_table[]" value="{{$bookingtable['id']}}"
                                type="checkbox" value="" id="flexCheckDefault" 
                                {{$bookingtable['is_assign_to_self']?"checked":""}}
                                {{$bookingtable['is_assign_to_other']?"disabled":""}}>
                            
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$bookingtable['table_number']}} ({{$bookingtable['seats']}} pax)
                                @if ($bookingtable['is_assign_to_other'])
                                    - not available (assigned to booking id {{$bookingtable['booking_informations']['booking_id']}} at {{$bookingtable['booking_informations']['booking_time']}})
                                 @endif
                            </label>
                           
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary mb-3">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
