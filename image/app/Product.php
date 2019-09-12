<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','price',];
    public function image()
    {
    	return $this->hasMany('App\Image',"image_id");
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
