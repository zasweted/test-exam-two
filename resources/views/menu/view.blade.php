@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row">
        <div class="col-5 mx-4">
            <div class="card">
                <h1 class=" card-header">{{ $menu->dish_name }}</h1>
                <div class="card-body">
                    <span style="font-weight: 600">Price:</span>
                    <h5 class="card-title">{{ $menu->price }}</h5>
                    <span style="font-weight: 600">Restaurant:</span>
                    <p class="card-text">{{ $menu->getRestaurant->rest_name }}</p>
                    <span class="mb-4" style="font-weight: 600">Image:</span>
                    <div >
                        <img class="w-100" src="/storage/{{ $menu->url }}" alt="img">
                    </div>
                </div>
                <div class="col-4 mx-3 mb-3">
                    <form action="{{ route('menu.delete', $menu) }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label class="col-form-label" for="rate_menu" style="font-weight: 600">Rate Dish:</label>
                                <input min="0" max="5" type="number" name="#" id="rate_menu" class="form-control">
                                <button type="submit" class="btn btn-warning mt-4">Rate</button>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{ route('menu.edit', $menu) }}" class="btn btn-success mt-4">Edit</a>
                                <button type="submit" class="btn btn-dark mt-4">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="col-4 mx-3 mt-4">
            <a href="{{ route('menu.index') }}" class="btn btn-danger">Back</a>
        </div>
        </div>
    </div>
</div>
</div>

@endsection
