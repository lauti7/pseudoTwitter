<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Message extends Model
{

    use Searchable;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function responses()
    {
        return $this->hasMany(Response::class)->with('user')->orderBy('created_at', 'desc');
    }

    //Convierte una propiedad en metodo, podria ser una URL tambien, recibe como parametro la propiedad en base de datos
    //Cuando le pidas este atrivuto al mensaje, va a hacer esta funcion lo intercepta
    public function getImageAttribute($image)
    {
    	if (!$image || starts_with($image, 'http')) {
    		return $image;
    	}

    	return 'http://localhost:8000/storage/'. $image;
    }

    public function toSearchableArray()
    {
        $this->load('user');

        return $this->toArray();
    }
}
