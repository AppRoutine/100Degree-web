<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Tutor extends Authenticatable
{
	protected $table='tutors';
    protected $fillable = [
    	'TutorName', 'EmailID', 'PhoneNo', 'Major', 'ProfilePicPath', 'Address', 'Description',
    ];

    public function majors()
    {
    	return $this->hasone('App\Major','id','Major');
    }


}
