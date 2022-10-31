<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function homeList()
    {
        return redirect()->route('restaurant.index');
    }
}
