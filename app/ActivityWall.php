<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ActivityWall extends Authenticatable
{
	protected $table='activity_wall';
    protected $fillable = [
    	'text','userid'
    ];

    public function images()
    {
    	return $this->hasmany('App\WallImages','wall_id')->select('images');
    }

    public function user()
    {
    	return $this->hasone('App\User','userid');
    }



}
