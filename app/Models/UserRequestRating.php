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
        'request_id', 
        'rating', 
        'message', 
        'request_model'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function request()
    {
        return $this->morphTo(null, 'request_model', 'request_id');
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
