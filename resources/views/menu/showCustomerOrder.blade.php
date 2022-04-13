@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>{{$customer_name}} Order on {{$selected_booking->booking_date}}</div>
                
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Dining Package</th>
                                <th scope="col">Quantity</th>
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