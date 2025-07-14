<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationTrackings extends Model
{
    use HasFactory;

    protected $table = 'certification_trackings';
    protected $fillable = [
        'id', 
        'user_id', 
        'name', 
        'user_type', 
        'event_id', 
        'event_name',
        'event_participant_certification_name',
        'status',
        'created_at',
        'updated_at'
    ]; 
}
