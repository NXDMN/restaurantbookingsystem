@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @can('isAdmin')
                    <a href="bookings/index" class="btn btn-primary btn-lg">
                        Bookings
                    </a>
                    @elsecan('isCustomer')
                    <a href="bookings/show" class="btn btn-primary btn-lg">
                        Bookings
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
