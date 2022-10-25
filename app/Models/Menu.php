<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['dish_name', 'price', 'url', 'restaurant_id'];

    // public function getRestaurant()
    // {
    //     return $this->belongsTo(Restaurant::class);
    // }
    public function getRestaurant()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id', 'id');
    }
}
