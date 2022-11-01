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
                                        <option value="price_asc" @if('price_asc'==$sortSelect) @endif>Price Low to High</option>
                                        <option value="price_desc" @if('price_desc'==$sortSelect) @endif>Price High to Low</option>
                                    </select>
                                    <button type="submit" class="btn p-0 px-2 btn-primary mx-2">Sort</button>
                                </div>


                                <div class="col-4 mb-4 mt-4">
                                    <label class="form-label mx-2" for="search">Search: </label>
                                    <input type="text" name="search" id="search" value="{{ $search }}">
                                    <button type="submit" class="btn p-0 px-2 btn-primary mx-2">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap">
                        @forelse($sortMenus as $menu)
                        <div class="col-5 mt-2 mb-2 mx-4">
                            <div class="card">
                                <h1 class="card-title ">{{ $menu->dish_name }}</h1>
                                <div class="card-body">
                                    <span style="font-weight: 600">Price:</span>
                                    <h5 class="card-title">{{ $menu->price }} $</h5>
                                    <span style="font-weight: 600">Image:</span>
                                    <img class="w-100" src="/storage/{{ $menu->url }}" alt="img">
                                    <div class="col-auto">
                                        <div>
                                            <label for="rate" class="col-form-label" style="font-weight: 600">Rate Menu Item:</label>
                                            <div>
                                                <form action="{{ route('restaurant.rate', $menu) }}" method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <select name="rate" id="rate">
                                                        @foreach(range(1, 5) as $rate)
                                                        <option value="{{ $rate }}">{{ $rate }} Star</option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn p-0 px-2 btn-warning mx-2">Rate</button>
                                                </form>
                                                <div class="mt-2">
                                                    <span style="font-weight: 600">Overall Rating: {{ $menu->rate_dish ?? 'No rating yet...' }}</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="row justify-content-center">
                            <div class="col-11 mx-4">
                                <h1>No Match Found ...</h1>
                            </div>
                        </div>
                        @endforelse


                    </div>
                    @if(Auth::user()->role >= 10)
                    <div class="col-2">
                        <form action="{{ route('restaurant.delete', $restaurant) }}" method="post" onsubmit="return confirm('Are you sure you want to delete {{ $restaurant->rest_name }}');">
                            @csrf
                            @method('delete')
                            <div class="row g-3 align-items-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('restaurant.edit', $restaurant) }}" class="btn btn-success mt-4">Edit</a>
                                    <button type="submit" class="btn btn-dark mt-4">Delete</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif
            </div>
        </div>
        <div class="col-4 mx-3 mt-4">
            <a href="{{ route('restaurant.index') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
</div>


@endsection
