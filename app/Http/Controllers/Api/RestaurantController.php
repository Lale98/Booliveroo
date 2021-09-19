<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Restaurant;
use App\Category;
use App\Plate;
use App\Type;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::paginate(6);
        $prova = Restaurant::with(['categories'])->get();


        /* $categories = Category::all(); */


        $restaurants->each(function ($restaurant) {
            if($restaurant->cover) {
                $restaurant->cover = url('storage/' . $restaurant->cover);
            } else {
                $restaurant->cover = url('img/placeholder.png');
            }
        });

        $data = [
            'prova' => $prova,
            'restaurants' => $restaurants
        ];

        return response()->json($data);
    }
    
    public function show(Request $request){

        $restaurant = Restaurant::where('slug', $request->slug)->with(['categories', 'plates'])->get();

        // $plate = Plate::where('slug', $request->slug)->with(['types'])->get();
        

        // $plate = Plate::where('slug', $request->slug)->with(['types'])->get();


        /* $piatti = Plate::where('restaurant_id', $request->id)->get();

         $data = [
            'restaurant' => $restaurant2,
            'piatti' => $piatti
        ];
        */
        return response()->json($restaurant);
    }
}
