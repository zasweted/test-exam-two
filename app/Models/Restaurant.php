<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['rest_name', 'city', 'address', 'open_at', 'close_at'];

    // public function getMenus()
    // {
    //     return $this->hasMany(Menu::class);
    // }
    public function getMenus()
    {
        return $this->hasMany(Menu::class, 'restaurant_id','id');
    }
}
