<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventactivitydropdowns extends Model
{
    use HasFactory;

    protected $table = 'event_activity_drop_downs';
    protected $fillable = [
        'id', 
        'event_activity_slug', 
        'event_activity_name',         
        'status',
        'created_at',
        'updated_at'
    ]; 
}
