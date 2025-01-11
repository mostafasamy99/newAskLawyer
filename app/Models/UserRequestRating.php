<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserRequestRating extends Model
{
    protected $table = 'user_request_ratings';

    protected $fillable = [
        'user_id', 
        'user_request_id', 
        'rating', 
        'message', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userRequest()
    {
        return $this->belongsTo(UserRequest::class);
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
