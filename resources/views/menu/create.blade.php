@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card t">
                <div class="card-header">
                    <h2>Menu Item Create</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('menu.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="dish_name" class="form-label">Menu Item</label>
                            <input type="text" name="dish_name" class="form-control" id="dish_name">
                            @error('dish_name')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" min="0" step="0.1" class="form-control" id="price">
                            @error('price')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="url" class="form-control" id="image">
                            @error('image')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <select class="form-select" name="restaurant_id">
                            @foreach($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" selected>{{ $restaurant->rest_name }}</option>
                            @endforeach
                            </select>
                            @error('restaurant_id')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>


                        <div>
                            <button type="submit" class="btn btn-primary mt-4">Create Menu Item</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@endsection
