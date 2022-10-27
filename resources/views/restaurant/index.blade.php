@extends('layouts.app')
@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-3">
            <h1>Restaurants List</h1>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <form action="{{ route('restaurant.index') }}" method="get">
            @csrf
            <div class="col-4 mb-4 mt-4">
                <label class="form-label mx-2" for="sort">Sort By: </label>
                <select name="sort" id="sort">
                    <option value="title_asc" @if('title_asc' == $sortSelect) selected @endif>Name A - Z</option>
                    <option value="title_desc" @if('title_desc' == $sortSelect) selected @endif>Name Z - A</option>
                </select>
                <button type="submit" class="btn p-0 px-2 btn-primary mx-2">Sort</button>
            </div>
        </form>
    </div>
</div>

<div class="row row-cols-9 row-cols-md-3 g-4 mx-2">
    @foreach($restaurants as $restaurant)
    <div class="col">
        <div class="card">
            <h1 class="card-header">{{ $restaurant->rest_name }}</h1>
            <div class="card-body">
                <span style="font-weight: 600">City:</span>
                <h5 class="card-title">{{ $restaurant->city }}</h5>
                <span style="font-weight: 600">Address:</span>
                <p class="card-text">{{ $restaurant->address }}</p>
                <p class="card-text"><span style="font-weight: 600">Restaurant open From </span>
                    {{ $restaurant->open_at }} <span style="font-weight: 600">to</span> {{ $restaurant->close_at }}</p>
                <p class="card-text"><span style="font-weight: 600">Restaurant Menu Items: </span>
                    {{ $restaurant->getMenus->count() }}</p>
                <div>
                    <a href="{{ route('restaurant.show', $restaurant) }}" class="btn btn-success">View Restaurant</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>


@endsection
