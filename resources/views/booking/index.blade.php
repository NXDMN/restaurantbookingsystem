@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Bookings</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                @can('viewAny', $booking)
                                <tr>
                                    <th scope="row">{{$booking['id']}}</th>
                                    <td>{{$booking['booking_date']}}</td>
                                    <td>{{date('h:i A', strtotime($booking['booking_time']))}}</td>
                                    <td>{{$booking['contact_no']}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn {{$booking['isConfirmed'] ? 'btn-success' : 'btn-warning'}} btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{$booking['isConfirmed'] ? 'Confirmed' : 'Pending'}}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <form method="POST" action="/bookings/updateStatus/{{$booking['id']}}">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="status" value="Pending"/>
                                                        <button type="submit" class="btn btn-link dropdown-item {{$booking['isConfirmed'] ? '' : 'active'}}">Pending</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="POST" action="/bookings/updateStatus/{{$booking['id']}}">
                                                        @csrf
                                                        @method('put')
                                                        <input type="hidden" name="status" value="Confirmed"/>
                                                        <button type="submit" class="btn btn-link dropdown-item {{$booking['isConfirmed'] ? 'active' : ''}}">Confirmed</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        
                                    </td>
                                </tr>
                                @endcan
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection