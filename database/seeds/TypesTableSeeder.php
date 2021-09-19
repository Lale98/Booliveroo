<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Type;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types =['Primo Piatto', 'Secondo Piatto', 'Antipasto', 'Dessert', 'Bevande Analcoliche', 'Bevande Alcoliche','Aperitivo', 'Contorno', 'Burgers', 'Pizza', 'Gelato', 'Menu', 'Portata Extra', 'Torte', 'Salse', 'Insalate', 'Kebab', 'Piadine'];

        foreach ($types as $type) {

            $newType = new Type();

            $newType->name = $type;
            $newType->slug = Str::slug($type, '-');

            $newType->save();
        }
    }
}
