<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Major extends Authenticatable
{
	protected $table='majors';
    protected $fillable = [
    	'major',
    ];



}
