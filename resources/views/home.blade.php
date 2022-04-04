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
                    <div class="btn btn-success btn-lg">
                        You have Admin Access
                    </div>
                    @elsecan('isCustomer')
                    <div class="btn btn-primary btn-lg">
                        You have Customer Access
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
