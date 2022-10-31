<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MenuController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menu.index', [
            'menus' => Menu::orderBy('dish_name', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create', [
            'restaurants' => Restaurant::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'dish_name' => 'required',
                'price' => 'required',
                'url' => ['required','image'],
                'restaurant_id' => 'required'
            ],
            [
                'dish_name.required' => 'The Menu Item field is required.',
                'price.required' => 'The Price field is required.',
                'url.required' => 'The Image is required.',
                'restaurant_id' => 'You must choose a Restaurant.'
                ]
            );
            
            $imagePath = request('url')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
            $image->save();

        Menu::create([
            'dish_name' => $request->dish_name,
            'price' => $request->price,
            'url' => $imagePath,
            'restaurant_id' => $request->restaurant_id
        ]);

        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('menu.view', [
            'menu' => $menu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', [
            'menu' => $menu,
            'restaurants' => Restaurant::orderBy('rest_name', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMenuRequest  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate(
            [
                'dish_name' => 'required',
                'price' => 'required',
                'url' => 'image',
                'restaurant_id' => 'required'
            ],
            [
                'dish_name.required' => 'The Menu Item field is required.',
                'price.required' => 'The Price field is required.',
                'url.required' => 'The Image is required.',
                'restaurant_id' => 'You must choose a Restaurant.'
            ]
        );

        if ($request->hasFile('url')) {
            $imagePath = request('url')->store('uploads', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(600, 600);
            $image->save();
            $menu->update([
                'dish_name' => $request->dish_name,
                'price' => $request->price,
                'url' => $imagePath,
                'restaurant_id' => $request->restaurant_id
            ]);
        }else{
            $menu->update([
                'dish_name' => $request->dish_name,
                'price' => $request->price,
                'restaurant_id' => $request->restaurant_id
            ]);
        }

        return redirect()->route('menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        if($menu->url){
            
            unlink(public_path().'/storage/'. $menu->url);
        }

        $menu->delete();
        return redirect()->route('menu.index');
    }
}
