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

    public function sortMenu($sort)
    {
        $sortedMenu = match($sort){
            'price_asc' => $this->hasMany(Menu::class, 'restaurant_id','id')->orderBy('price', 'asc')->get(),
            'price_desc' => $this->hasMany(Menu::class, 'restaurant_id','id')->orderBy('price', 'desc')->get(),
            default => $this->hasMany(Menu::class, 'restaurant_id','id')->get()
        };

        return $sortedMenu;
    }
}
