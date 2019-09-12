<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['src','imageable_type','imageable_id'];
    public function imagetable()
    {
    	return $this->morphTo();
    }
}
