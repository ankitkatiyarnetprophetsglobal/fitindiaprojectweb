<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class AppBanner extends Model
{
     protected $table = 'mobilesplashscreensliders';
   protected $fillable = [
        'name', 'type', 'landing_url', 'banner_url',
        'language', 'duration', 'start_from', 'end_to',
        'order', 'status'
    ];
}
