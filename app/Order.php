<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function plates(){
        return $this->belongsToMany('App\Plate');
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }

    protected $fillable = [
        'state',
        'payment',
        'price',
        'name',
        'restaurant_id',
        'lastname',
        'address',
        'phone',
        'email',
        'riepilogo'
    ];
}
