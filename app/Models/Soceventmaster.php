<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soceventmaster extends Model
{
    use HasFactory;
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
