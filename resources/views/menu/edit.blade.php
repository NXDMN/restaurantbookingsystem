@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Menu Package</div>
                <div class="card-body">
                    <form method="POST" action='/menu/edit'>
                        @csrf
                        <input type="hidden" name="id" value="{{$menu['id']}}"/>

                        <div class="mb-3">
                            <label for="dining_package" class="form-label">Dining Package</label>
                            <input 
                            class="form-control @error('dining_package') is-invalid @enderror" 
                            id="dining_package" 
                            name="dining_package"
                            value="{{$menu['dining_package']}}">
                            @error('dining_package')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="items" class="form-label">Items</label>
                            <input
                            type="text" 
                            class="form-control @error('items') is-invalid @enderror" 
                            id="items"
                            name="items"
                            value="{{$menu['items']}}">
                            @error('items')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input
                            type="text" 
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description"
                            name="description"
                            value="{{$menu['description']}}">
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mb-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection