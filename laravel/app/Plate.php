<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plate extends Model
{
    protected $fillable = [
        'name',
        'restaurant_id',
        'type_id',
        'slug',
        'description',
        'img',
        'veg',
        'availability',
        'price'
    ];

    public function restaurant(){
        return $this->belongsTo('App\Restaurant');
    }

    public function types(){
        return $this->belongsToMany('App\Type');
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }
}
