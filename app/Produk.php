<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function scopeMungkinJugaSuka($query)
    {
        return $query->inRandomOrder()->take(4);
    }
}
