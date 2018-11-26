<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Sport extends Authenticatable
{
	protected $table='sports';
    protected $fillable = [
    	'SportName','SportType','StartDate','StartTime','EndTime','Teams','TeamsList','Address','Description'
    ];



}
