<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Music extends Authenticatable
{
	protected $table='musics';
    protected $fillable = [
    	'music',
    ];



}
