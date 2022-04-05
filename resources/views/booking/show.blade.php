@extends('layouts.auth')

@section('content')
<div class="container">
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
                                <th scope="col">No. of person</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($bookings as $booking)
                            @can('view', $booking)
                            <tr>
                                <th scope="row">{{$booking['id']}}</th>
                                <td>{{$booking['booking_date']}}</td>
                                <td>{{date('h:i A', strtotime($booking['booking_time']))}}</td>
                                <td>{{$booking['contact_no']}}</td>
                                <td>{{$booking['no_of_person']}}</td>
                                <td>{{$booking['isConfirmed'] ? 'Confirmed' : 'Pending'}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="actions">
                                        @can('update', $booking)
                                        <a class="btn btn-warning btn-sm" href="/bookings/edit/{{$booking['id']}}" role="button">Edit</a>
                                        @endcan

                                        @can('delete', $booking)
                                        <form method="post" action="/bookings/{{$booking['id']}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                        @endcan
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