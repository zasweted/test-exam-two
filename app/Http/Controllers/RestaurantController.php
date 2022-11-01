<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Restaurant $restaurant)
    {

        $restaurants = $restaurant->sortRestaurants($request->sort);

        return view('restaurant.index', [
            'restaurants' => $restaurants,
            'sortSelect' => $request->sort,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRestaurantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'rest_name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'open_at' => 'required',
                'close_at' => 'required'
            ],
            [
                'rest_name.required' => 'The Restaurant Name field is required.',
                'city.required' => 'The City field is required.',
                'address.required' => 'The Address field is required.',
                'open_at.required' => 'The Hours From  field is required.',
                'close_at.required' => 'The Hours To field is required.',
            ]
        );

        Restaurant::create([
            'rest_name' => $request->rest_name,
            'city' => $request->city,
            'address' => $request->address,
            'open_at' => $request->open_at,
            'close_at' => $request->close_at
        ]);

        return redirect()->route('restaurant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant, Request $request)
    {
        $sortMenus = $restaurant->sortAndSearchAllInOneMethod($request);
        
        return view('restaurant.view', [
            'restaurant' => $restaurant,
            'sortMenus' => $sortMenus,
            'sortSelect' => $request->sort,
            'search' => $request->search ?? ''
        ]);
    }

    public function rateMenu(Menu $menu, Request $request)
    {

        $menu->rate_dish_sum = $menu->rate_dish_sum + $request->rate;
        $menu->rate_dish_count ++;
        $menu->rate_dish = $menu->rate_dish_sum / $menu->rate_dish_count;
        $menu->save();
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurant.edit', [
            'restaurant' => $restaurant
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRestaurantRequest  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate(
            [
                'rest_name' => 'required',
                'city' => 'required',
                'address' => 'required',
                'open_at' => 'required',
                'close_at' => 'required'
            ],
            [
                'rest_name.required' => 'The Restaurant Name field is required.',
                'city.required' => 'The City field is required.',
                'address.required' => 'The Address field is required.',
                'open_at.required' => 'The Hours From  field is required.',
                'close_at.required' => 'The Hours To field is required.',
            ]
        );

        $restaurant->update([
            'rest_name' => $request->rest_name,
            'city' => $request->city,
            'address' => $request->address,
            'open_at' => $request->open_at,
            'close_at' => $request->close_at
        ]);

        return redirect()->route('restaurant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        foreach ($restaurant->getMenus as $menu)
            if ($menu->url) {


                unlink(public_path() . '/storage/' . $menu->url);
            }
        $restaurant->getMenus()->delete();
        $restaurant->delete();

        return redirect()->route('restaurant.index');
    }
}
