<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;

class HomeController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function showRestaurant() {
        $newRestaurant = Restaurant::where('user_id', Auth::user()->id)->first();//o get

        return view('admin.home', compact('newRestaurant'));
    }
}
