<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['Italiano', 'Pizza', 'Cinese', 'Sushi', 'Indiano', 'Giapponese', 'Thailandese', 'Fast-Food', 'Birreria', 'Kebab', 'Messicano', 'Hamburger', 'Gelato', 'Americano', 'Poke', 'Healty', 'Pub', 'Pasticceria', 'Panini', 'Pesce', 'Snack', 'Piadina', 'Pasta', 'Insalate', 'Carne', 'Africano', 'Gourmet'];

        foreach ($categories as $category) {

            $newCategory = new Category();

            $newCategory->name = $category;
            $newCategory->slug = Str::slug($category, '-');

            $newCategory->save();
        }
    }
}
