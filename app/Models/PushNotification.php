<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PushNotification extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="push_notification";
    protected $fillable=['message_file','message_title','message_description','updated_at','created_at'];

}
