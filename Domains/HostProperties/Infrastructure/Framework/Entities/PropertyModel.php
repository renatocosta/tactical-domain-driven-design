<?php

namespace Domains\HostProperties\Infrastructure\Framework\Entities;

use Illuminate\Database\Eloquent\Model;

class PropertyModel extends Model
{

    protected $table = 'property';

    protected $fillable = ['name', 'room'];

}
