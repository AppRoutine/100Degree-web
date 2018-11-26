<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class University extends Authenticatable
{
	protected $table='universities';
    protected $fillable = [
    	'University',
    ];



}
