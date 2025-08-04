<?php

namespace App\Models\QuizmasterModel;

use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
     protected $table = 'ver_check';
     public $timestamps = false;
   protected $fillable = [
    'name', 'platform', 'version', 'type', 'updateStatus', 'status',
    'description', 'release_date', 'created_date'
];
}
