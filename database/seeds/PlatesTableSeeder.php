<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Plate;

class PlatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayPlates = config('plates');

        foreach ($arrayPlates as $item) {
            $newPlate = new Plate();

            $newPlate->name = $item['name'];
            $newPlate->restaurant_id = $item['restaurant_id'];
            $newPlate->slug = Str::slug($newPlate->name, '-');
            $newPlate->description = $item['description'];
            $newPlate->img = $item['img'];
            $newPlate->price = $item['price'];
            $newPlate->veg = $item['veg'];
            $newPlate->availability = $item['availability'];

            $newPlate->save();
        }
    }
}
