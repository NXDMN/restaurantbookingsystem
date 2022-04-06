@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Booking Tables</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Booking ID</th>
                                <th scope="col">Table Number</th>
                                <th scope="col">Seats</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookingtables as $bookingtable)
                                @can('viewAny', $bookingtable)
                                <tr>
                                    <th scope="row">{{$bookingtable['id']}}</th>
                                    <td>{{$bookingtable['booking_id']}}</td>
                                    <td>{{$bookingtable['table_number']}}</td>
                                    <td>{{$bookingtable['seats']}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="actions">
                                            @can('update', $bookingtable)
                                            <a class="btn btn-warning btn-sm" href="/bookingtables/edit/{{$bookingtable['id']}}" role="button">Edit</a>
                                            @endcan

                                            @can('delete', $bookingtable)
                                            <form method="post" action="/bookingtables/{{$bookingtable['id']}}">
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