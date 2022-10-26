@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-11 mx-4">
        <div class="card">
            <h1 class=" card-header">{{ $restaurant->rest_name }}</h1>
            <div class="card-body">
                <span style="font-weight: 600">City:</span>
                <h5 class="card-title">{{ $restaurant->city }}</h5>
                <span style="font-weight: 600">Address:</span>
                <p class="card-text">{{ $restaurant->address }}</p>
                <p class="card-text"><span style="font-weight: 600">Restaurant open From </span>
                    {{ $restaurant->open_at }} <span style="font-weight: 600">to</span> {{ $restaurant->close_at }}</p>
                <p class="card-text"><span style="font-weight: 600">Restaurant Menu Items: </span>
                    <div class="container">
                        <div class="row">
                            <form action="{{ route('restaurant.show', $restaurant) }}" method="get">
                                @csrf
                                <div class="col-4 mb-4 mt-4">
                                    <label class="form-label mx-2" for="sort">Sort By: </label>
                                    <select name="sort" id="sort">
                                        <option value="price_asc" @if('price_asc'==$sortSelect) selected @endif>Price Low to High</option>
                                        <option value="price_desc" @if('price_desc'==$sortSelect) selected @endif>Price High to Low</option>
                                    </select>
                                    <button type="submit" class="btn p-0 px-2 btn-primary mx-2">Sort</button>
                                </div>
                            </form>
                            <form action="{{ route('restaurant.show', $restaurant) }}" method="get">
                                @csrf
                                <div class="col-4 mb-4 mt-4">
                                    <label class="form-label mx-2" for="search">Search: </label>
                                    <input type="text" name="search" id="search" value="{{ $search }}">
                                    <button type="submit" class="btn p-0 px-2 btn-primary mx-2">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        @foreach($searchMenus as $menu)
                        <div class="col-3 mt-2 mb-2 mx-4">
                            <div class="card">
                                <h1 class="card-title ">{{ $menu->dish_name }}</h1>
                                <div class="card-body">
                                    <span style="font-weight: 600">Price:</span>
                                    <h5 class="card-title">{{ $menu->price }} $</h5>
                                    <span style="font-weight: 600">Image:</span>
                                    <img class="w-100" src="/storage/{{ $menu->url }}" alt="img">
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="col-4">
                        <form action="{{ route('restaurant.delete', $restaurant) }}" method="post" onsubmit="return confirm('Are you sure you want to delete {{ $restaurant->rest_name }}');">
                            @csrf
                            @method('delete')
                            <div class="row g-3 align-items-center">
                                <div class="col-auto">
                                    <label class="col-form-label" style="font-weight: 600">Rate Us:</label>
                                    <input min="0" max="5" type="number" name="open_at" id="open_at" class="form-control">
                                    <button type="submit" class="btn btn-warning mt-4">Rate</button>
                                </div>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('restaurant.edit', $restaurant) }}" class="btn btn-success mt-4">Edit</a>
                                    <button type="submit" class="btn btn-dark mt-4">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
        <div class="col-4 mx-3 mt-4">
            <a href="{{ route('restaurant.index') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
</div>


@endsection
