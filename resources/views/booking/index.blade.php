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
                                <th scope="col">Customer Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">No. of person</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Assigned Table</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $index => $booking)
                            @can('viewAny', $booking)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>{{$informations[$index]['customer_name']}}</td>
                                <td>{{$booking['booking_date']}}</td>
                                <td>{{date('h:i A', strtotime($booking['booking_time']))}}</td>
                                <td>{{$booking['contact_no']}}</td>
                                <td>{{$booking['no_of_person']}}</td>
                                <td>
                                    <div class="dropdown">
                                        <button
                                            class="btn {{$booking['booking_status'] == "Confirmed" ? 'btn-success' : ($booking['booking_status'] == "Pending" ?'btn-warning' :'btn-danger')}} btn-sm dropdown-toggle"
                                            type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            {{$booking['booking_status']}}
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <form method="POST" action="/bookings/updateStatus/{{$booking['id']}}">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="Pending" />
                                                    <button type="submit"
                                                        class="btn btn-link dropdown-item {{$booking['booking_status'] == "Pending" ?'active' : ''}}">Pending</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="POST" action="/bookings/updateStatus/{{$booking['id']}}">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="Confirmed" />
                                                    <button type="submit"
                                                        class="btn btn-link dropdown-item {{$booking['booking_status'] == "Confirmed" ? 'active' : ''}}">Confirmed</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="POST" action="/bookings/updateStatus/{{$booking['id']}}">
                                                    @csrf
                                                    @method('put')
                                                    <input type="hidden" name="status" value="Cancelled" />
                                                    <button type="submit"
                                                        class="btn btn-link dropdown-item {{$booking['booking_status'] == "Cancelled" ? 'active' : ''}}">Cancelled</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="actions">
                                        <a class="btn btn-primary btn-sm"
                                            href="/bookingtables/assign/{{$booking['id']}}" role="button">Assign
                                            Table</a>
                                    </div>
                                </td>
                                @if($informations[$index]['total_seat']==0)
                                    <td>None</td> 
                                @else
                                    <td>{{$informations[$index]['table_numbers']}}({{$informations[$index]['total_seat']}}pax)</td>
                                @endif
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
