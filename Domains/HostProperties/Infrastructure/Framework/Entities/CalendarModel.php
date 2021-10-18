<?php

namespace Domains\HostProperties\Infrastructure\Framework\Entities;

use Illuminate\Database\Eloquent\Model;

class CalendarModel extends Model
{

    protected $table = 'calendar';

    protected $fillable = ['url', 'property_id'];

}
