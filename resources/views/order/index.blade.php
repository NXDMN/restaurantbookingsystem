@extends('layouts.auth')
@section('content')
<div class="container">
    @include('flashMessage')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>My Orders</div>
                        <a class="btn btn-primary" href="/orders/create" role="button">Add Order</a>
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
                        @foreach($orderlist as $order)
                            @if($order['booking_id'] == session('booking_id'))
                                @can('view', $order)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$order['dining_package']}}</td>
                                    <td>{{$order['quantity']}}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="actions" >
                                            
                                                @can('update', $order)
                                                    <a class="btn btn-warning btn-sm" href="/orders/edit/{{$order['id']}}" role="button">Edit</a>
                                                @endcan
                                                
                                                @can('delete', $order)
                                                <form method="post" action="/orders/{{$order['id']}}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                                @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endcan
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection