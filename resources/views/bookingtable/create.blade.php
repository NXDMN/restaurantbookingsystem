@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Table For The Eats</div>
                <div class="card-body">
                    <form method="POST" action='/bookingtables/create'>
                        @csrf
                        <div class="mb-3">
                            <label for="table_number" class="form-label">Table Number</label>
                            <input 
                            class="form-control @error('table_number') is-invalid @enderror" 
                            id="table_number" 
                            name="table_number">
                            @error('table_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="seats" class="form-label">Seats (1 to 8)</label>
                            <input
                            type="number" 
                            class="form-control @error('seats') is-invalid @enderror" 
                            id="seats"
                            name="seats">
                            @error('seats')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection