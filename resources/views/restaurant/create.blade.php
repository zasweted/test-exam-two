@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <div class="card t">
                <div class="card-header">
                    <h2>Restaurant Create</h2>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('restaurant.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="rest_name" class="form-label">Restaurant Name</label>
                            <input type="text" name="rest_name" class="form-control" id="res_name">
                            @error('rest_name')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" name="city" class="form-control" id="city">
                            @error('city')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="address">
                            @error('address')
                            <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row g-3 align-items-center">
                            <div>Working Hours</div>
                            <div class="col-auto">
                                <label class="col-form-label">From:</label>
                            </div>
                            <div class="col-4">
                                <input type="time" min="0" max="24" name="open_at" id="open_at" class="form-control">
                            </div>
                            <div class="col-auto">
                                <label class="col-form-label">To:</label>
                            </div>
                            <div class="col-4">
                                <input type="time" min="0" max="24" name="close_at" id="close_at" class="form-control">
                            </div>
                            @error('open_at')
                                <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                            @error('close_at')
                                <div style="color: crimson; font-size:12px">{{ $message }}</div>
                            @enderror
                            <div>
                                <button type="submit" class="btn btn-primary mt-4">Create Restaurant</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
