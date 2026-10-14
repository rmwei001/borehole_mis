<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    protected $fillable = [
        'name',
        'longitude',
        'latitude',
        'water_rate',
        'meter_number',
        'location_id'
    ];
}
