<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{

    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'piva',
        'address',
        'phone_number',
        'description',
        'cover'
    ];


    public function user() {
        return $this->belongsTo('App\User');
    }

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function plates(){
        return $this->hasMany('App\Plate');
    }
}
