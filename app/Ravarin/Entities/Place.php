<?php

namespace Ravarin\Entities;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = [
        'name', 'excerpt', 'description', 'street', 'subdistrict',
        'district', 'province', 'postcode', 'latitude', 'longitude'
    ];
}
