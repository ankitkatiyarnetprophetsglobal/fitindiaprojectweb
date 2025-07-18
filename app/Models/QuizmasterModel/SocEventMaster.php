<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class SocEventMaster extends Model
{
        protected $table = 'soc_event_masters';
        protected $fillable = [
            'venue',
            'cycle',
            't_shirt',
            'meal',
            'latitude',
            'longitude',
            'event_date',
            'status',
            'created_at',
            'updated_at',
        ];
}