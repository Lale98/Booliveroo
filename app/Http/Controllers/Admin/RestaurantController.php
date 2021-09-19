<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;
use App\Category;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->restaurant->id;

        $restaurant = Restaurant::where('user_id', $user)->get();

        return redirect()->route('admin.index', compact('restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        
        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);

        $request->validate([
            'name'=> 'required|min:2|max:80',
            'piva' => 'required|max:11',
            'address' => 'required|min:2|max:255',
            'phone_number' => 'required|numeric|unique:restaurants',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,svg|max:5000',
        ],
        [
            'required'=> 'Questo campo è obbligatorio',
            'name.max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
            'numeric' => 'Inserisci solo numeri',
            'mimes' => 'I formati supportati sono: jpg,jpeg,png,bmp,svg',
            'image.max' => 'Il file inserito eccede le misure massime consentite(5000kb )',
            'phone_number.unique'=> 'il numero inserito è già esistente'
        ]);

        $newRestaurant = new Restaurant();
        $newRestaurant->slug = Str::slug($data['name'], '-');

        if(array_key_exists('cover', $data )){
            $data['cover'] = Storage::put('post_covers', $data['cover']);
        }

        $newRestaurant->fill($data);
        $newRestaurant->user_id = Auth::user()->id;
       
        $newRestaurant->save();
        if(array_key_exists('category', $data )){
            $newRestaurant->categories()->attach($data["category"]);
        }

        return redirect()
            ->route('admin.restaurants.index')
            ->with('message', 'La creazione è avvenuta con successo!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        return view('admin.restaurants.edit', compact('restaurant','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $data = $request->all();
        //dd($data);

        $request->validate([
            'name'=> 'required|min:2|max:80',
            'piva' => 'required|max:11',
            'address' => 'required|min:2|max:255',
            'phone_number' => 'required|numeric',
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,svg|max:5000',
        ],
        [
            'required'=> 'Questo campo è obbligatorio',
            'name.max'=> 'Massimo :max caratteri concessi',
            'min'=> 'Minimo :min caratteri richiesti',
            'numeric' => 'Inserisci solo numeri',
            'mimes' => 'I formati supportati sono: jpg,jpeg,png,bmp,svg',
            'image.max' => 'Il file inserito eccede le misure massime consentite(5000kb )',
            'phone_number.unique'=> 'il numero inserito è già esistente'
        ]);

        if($data['name'] != $restaurant->name) {

            $slug = Str::slug($data['name'], '-');
        
            $slugVerifica = Restaurant::where('slug', $slug)->first();
            //dd($slugVerifica);
    
            $slug_base = $slug;
            $count = 1;
    
            while($slugVerifica != null){
                
                $slug = $slug_base . "-" . $count;
    
                $slugVerifica = Restaurant::where('slug', $slug)->first();
                $count++;
            }

            $data['slug'] = $slug;
        }  

        if(array_key_exists('cover', $data )){

            if($restaurant->cover) {
               Storage::delete($restaurant->cover);
            }
            $data['cover'] = Storage::put('post_covers', $data['cover']);
        }

        $restaurant->user_id = Auth::user()->id;
       
        $restaurant->update($data);
        if(array_key_exists('category', $data )){
            $restaurant->categories()->sync($data["category"]);
        }else {
            $restaurant->categories()->detach();
        }
        return redirect()->route('admin.restaurants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        if($restaurant->cover) {
            Storage::delete($restaurant->cover);
        }

        $restaurant->delete();
        return redirect()
            ->route('admin.restaurants.index')
            ->with('deleted', $restaurant->name);
    }
}
