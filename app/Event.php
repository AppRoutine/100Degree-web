<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Event extends Authenticatable
{
	protected $table='events';
    protected $fillable = [
    	'EventName', 'StartDate', 'StartTime', 'EndTime', 'BannerImg', 'Venu', 'AboutEvent', 'BuyTicketURL', 'Organizer', 'OrganizerImg',
    ];

        public function majors()
    {
    	return $this->hasone('App\Major','Major');
    }



}
