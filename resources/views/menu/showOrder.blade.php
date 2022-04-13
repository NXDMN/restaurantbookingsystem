@extends('layouts.auth')
@section('content')
<div class="container">
    @include('flashMessage')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>My Order on {{$selected_booking->booking_date}} {{$is_future_date?"":"(expired)"}}
                            <br/> *If same dining package is placed, it will overwrite the old one.</div>
                        <a class="btn btn-primary {{$is_future_date?"":"disabled"}}" href="/menu/createOrder/{{$selected_booking['id']}}" role="button">Add</a>
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
                            <tr>
                                @foreach($menulist as $menu)
                                    @if($menu['id'] == $booking->pivot->menu_id)
                                        <th scope="row">{{$i++}}</th>
                                        <td>{{$menu['dining_package']}}</td>
                                        <td>{{$booking->pivot->quantity}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="actions" >
                                                    <a class="btn btn-warning btn-sm {{$is_future_date?"":"disabled"}}" href="/menu/editOrder/{{$selected_booking['id']}}/{{$booking['id']}}" role="button">Edit</a>
                                                    
                                                    <form method="post" action="/menu/destroyOrder/{{$selected_booking['id']}}/{{$booking['id']}}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger btn-sm {{$is_future_date?"":"disabled"}}">Delete</button>
                                                    </form>
                                            </div>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection