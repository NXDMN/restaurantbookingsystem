@extends('layouts.auth')
@section('content')
<div class="container">
    @include('flashMessage')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>My Order <br/> *One Package only can have 1 Order.</div>
                        <a class="btn btn-primary" href="/menu/createOrder/{{$selected_booking['id']}}" role="button">Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Dining Package</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php ($i = 1)
                        @foreach($booking_menu as $booking)
                            @can('view', $booking)
                            <tr>
                                @foreach($menulist as $menu)
                                    @if($menu['id'] == $booking->pivot->menu_id)
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$menu['dining_package']}}</td>
                                        <td>{{$booking->pivot->quantity}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="actions" >
                                                    @can('update', $menu)
                                                    <a class="btn btn-warning btn-sm" href="/menu/editOrder/{{$selected_booking['id']}}/{{$booking['id']}}" role="button">Edit</a>
                                                    @endcan
                                                    
                                                    @can('delete', $booking)
                                                    <form method="post" action="/menu/destroyOrder/{{$selected_booking['id']}}/{{$booking['id']}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                    @endcan
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
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