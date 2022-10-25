@extends('layouts.app')
@section('content')
<div class="container mb-4">
    <div class="row justify-content-end">
        <div class="col-2">
            <a href="{{ route('restaurant.create') }}" class="btn btn-info">Add New Restaurant</a>
            <a href="{{ route('menu.create') }}" class="btn btn-info">Add Menu Item</a>
        </div>
    </div>

</div>


<div class="row row-cols- row-cols-md-3 g-4 mx-2">
    @foreach($menus as $menu)
    <div class="col">
        <div class="card">
            <h1 class="card-header">{{ $menu->dish_name }}</h1>
            <div class="card-body">
                <span style="font-weight: 600">Price:</span>
                <h5 class="card-title">{{ $menu->price }} $</h5>
                <span style="font-weight: 600">Restaurant:</span>
                <p class="card-text">{{ $menu->getRestaurant->rest_name }}</p>
                <span style="font-weight: 600">Image:</span>
                <img class="w-100" src="/storage/{{ $menu->url }}" alt="img">
                
                <div class="mt-4">
                    <a href="{{ route('menu.show', $menu) }}" class="btn btn-success">View Menu Item</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>


@endsection
