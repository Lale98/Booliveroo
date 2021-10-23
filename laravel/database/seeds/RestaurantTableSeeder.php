<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Restaurant;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayRestaurant = config('restaurant');

        foreach ($arrayRestaurant as $item) {
            $newRestaurant = new Restaurant();

            $newRestaurant->name = $item['name'];
            $newRestaurant->user_id = $item['user_id'];
            $newRestaurant->slug = Str::slug($newRestaurant->name, '-');
            $newRestaurant->piva = $item['piva'];
            $newRestaurant->address = $item['address'];
            $newRestaurant->phone_number = $item['phone_number'];
            $newRestaurant->description = $item['description'];
            $newRestaurant->cover = $item['cover'];

            $newRestaurant->save();
        }
    }
}
