@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div> All Menu Packages</div>
                        <a class="btn btn-primary" href="/menu/create" role="button">Add Package</a>
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
                                <th scope="col">Actions</th>
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
                                    <td>
                                        <div class="btn-group" role="group" aria-label="actions">
                                            @can('update', $menu)
                                            <a class="btn btn-warning btn-sm" href="/menu/edit/{{$menu['id']}}" role="button">Edit</a>
                                            @endcan

                                            @can('delete', $menu)
                                            <form method="post" action="/menu/{{$menu['id']}}">
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