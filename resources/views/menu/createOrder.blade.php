@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>  Add <strong>Order</strong> for Bookings id {{$booking['id']}} - require
                    ({{$booking['no_of_person']}}pax) at {{$booking['booking_time']}} 
                    <br>*Customer can order in the restaurant </div></div>
                    </div>
                   
                <div class="card-body">         
                    <form method="POST" action='/menu/createOrder'>
                        @csrf
                        <input type="hidden" name="booking_id" id="booking_id"  value="{{$booking['id']}}" />
          
                            <div class="mb-3">
                                <label for="menu_id" class="form-label">Dining Package</label>
                                <select
                                class="form-control @error('menu_id') is-invalid @enderror" 
                                id="menu_id" 
                                name="menu_id">
                                    @foreach($menulist as $item)
                                        <option value="{{$item['id']}}">{{$item['dining_package']}}</option>
                                    @endforeach
                                </select>

                                @error('menu_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input
                                type="number" 
                                class="form-control @error('quantity') is-invalid @enderror" 
                                id="quantity"
                                name="quantity">

                                @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                        <button type="submit" class="btn btn-primary mb-3">Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div> All Menu Packages</div>
                    </div>
                </div>
                <div class="card-body">
                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Package</th>
                                <th scope="col">Items</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menulist as $menu)
                                @can('viewAny', $menu)
                                <tr>
                                    <th scope="row">{{$menu['id']}}</th>
                                    <td>{{$menu['dining_package']}}</td>
                                    <td>{{$menu['items']}}</td>
                                    <td>{{$menu['description']}}</td>
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
