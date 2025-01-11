<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RequestNotification extends Model
{
    protected $table = 'request_notifications';
    protected $fillable = [
        'user_request_id',
        'user_request_type',
        'sender_id',
        'sender_type',
        'receiver_id',
        'receiver_type',
        'title',
        'body',
        'is_read',
    ];

    public function userRequest()
    {
        return $this->morphTo();
    }

    public function sender()
    {
        return $this->morphTo();
    }

    public function receiver()
    {
        return $this->morphTo();
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y, h:i A'); 
    }
        
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y, h:i A'); 
    }
}
