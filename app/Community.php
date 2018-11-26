<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Community extends Authenticatable
{
	protected $table='community';
    protected $fillable = [
    	'ServiceTitle', 'Venue', 'StartDate', 'StartTime', 'EndTime', 'BannerPic', 'State', 'City', 'AboutService', 'Organizer', 'OrganizerImg',
    ];



}
