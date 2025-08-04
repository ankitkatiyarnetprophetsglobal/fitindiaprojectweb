<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExeventRegistration extends Model
{
    use HasFactory;

    protected $table = 'external_event_registration';
    protected $fillable = [
        'external_evt_id', 
        'user_id', 
        'registration_type', 
        'org_name', 
        'num_of_participant', 
        'state_id',
        'state_name',
        'district_id',
        'district_name'
    ]; 
}
