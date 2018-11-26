<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class WallImages extends Authenticatable
{
	protected $table='wall_images';
    protected $fillable = [
    	'wall_id','images'
    ];



}
