@extends('layouts.auth')
@section('content')
<div class="container">
    @include('flashMessage')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>My Bookings</div>
                        <a class="btn btn-primary" href="/bookings/create" role="button">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Pax number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                                <th scope="col">Your Table</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php ($i = 1)
                        @foreach($bookings as $index => $booking)
                            @can('view', $booking)
                            <tr>
                                <th scope="row">{{$i++}}</th>
                                <td>{{$booking['booking_date']}}</td>
                                <td>{{date('h:i A', strtotime($booking['booking_time']))}}</td>
                                <td>{{$booking['contact_no']}}</td>
                                <td>{{$booking['no_of_person']}}</td>
                                <td>{{$booking['booking_status']}}</td>
                                <td>
                                        <div class="btn-group" role="group" aria-label="actions" >
                                            @can('update', $booking)
                                                <a class="btn btn-warning btn-sm {{$informations[$index]['is_future_date']?"":"disabled"}} " href="/bookings/edit/{{$booking['id']}}" role="button">Edit</a>
                                            @endcan
                                            
                                            @can('delete', $booking)
                                            <form method="post" action="/bookings/{{$booking['id']}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm {{$informations[$index]['is_future_date']?"":"disabled"}}">Delete</button>
                                            </form>
                                            @endcan
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