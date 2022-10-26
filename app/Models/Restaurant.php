<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['rest_name', 'city', 'address', 'open_at', 'close_at'];

    
    public function getMenus()
    {

        return $this->hasMany(Menu::class, 'restaurant_id','id');
    }

    public function sortRestaurants($sort)
    {
        $sortedRestaurants = match($sort){
            'title_asc' => Restaurant::orderBy('rest_name', 'asc')->get(),
            'title_desc' => Restaurant::orderBy('rest_name', 'desc')->get(),
            default => Restaurant::all()
        };

        return $sortedRestaurants;
    }

    public function sortMenu($sort)
    {
        $sortedMenu = match($sort){
            'price_asc' => $this->hasMany(Menu::class, 'restaurant_id','id')->orderBy('price', 'asc')->get(),
            'price_desc' => $this->hasMany(Menu::class, 'restaurant_id','id')->orderBy('price', 'desc')->get(),
            default => $this->hasMany(Menu::class, 'restaurant_id','id')->get()
        };

        return $sortedMenu;
    }

    public function searchMenu($search)
    {
        if($search){
            $searchMenu = explode(' ', $search);
            if(count($searchMenu) == 1){
                return $this->hasMany(Menu::class, 'restaurant_id', 'id')->where('dish_name', 'like', '%'.$search.'%');
            }else{
                return $this->hasMany(Menu::class, 'restaurant_id', 'id')
                ->where('dish_name', 'like', '%'.$searchMenu[0].'%'.$searchMenu[1].'%')
                ->orWhere('dish_name', 'like', '%'.$searchMenu[1].'%'.$searchMenu[0].'%')
                ->orWhere('dish_name', 'like', '%'.$searchMenu[0].'%')
                ->orWhere('dish_name', 'like', '%'.$searchMenu[1].'%')->get();
            }
        }else{
            return $this->hasMany(Menu::class, 'restaurant_id','id')->get();
        }
        
    }
}
