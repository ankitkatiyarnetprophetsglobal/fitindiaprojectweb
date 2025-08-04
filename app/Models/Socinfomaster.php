<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socinfomaster extends Model
{
    use HasFactory;
    protected $table = 'socinfomasters';

    protected $fillable = [
        'id',
        'name_center',
        'type_center',
        'location',
        'date',
        'cycling_route_start_from',
        'cycling_route_end',
        'number_participants',
        'status',
        'created_name',
        'updated_name',
        'created_email',
        'updated_email',
        'created_at',
        'updated_at',
    ];
}
