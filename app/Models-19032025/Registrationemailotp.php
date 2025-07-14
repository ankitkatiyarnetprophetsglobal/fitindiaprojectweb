<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Registrationemailotp extends Model
{
    use HasFactory;
    protected $table ='registration_email_otp_trackings';
    protected $appends  = ['encryptid'];
    protected $fillable = [
        'mode',
		'email',
        'mobile',
		'verify_otp', 
		'verified_otp',       
        'status'
        ];  	
}
