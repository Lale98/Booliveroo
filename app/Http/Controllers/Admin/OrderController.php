<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index(){

        $restaurant = Auth::user()->restaurant->id;
        $orders = Order::where('restaurant_id', $restaurant)->orderBy('created_at', 'desc')->get();
        return view('admin.orders.index', compact('orders'));
    }
}
