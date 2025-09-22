<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class SocEventMaster extends Model
{
        protected $table = 'soc_event_masters';
        protected $fillable = [
            'venue',
            'cycle',
            'cycle_waiting',
            't_shirt',
            'tshirt_waiting',
            'meal',
            'meal_waiting',
            'latitude',
            'longitude',
            'event_date',
            'status',
            'created_at',
            'updated_at',
        ];
}
