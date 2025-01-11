<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserRequest extends Model
{

    protected $table = 'user_requests';

    protected $fillable = [
        'user_id', 
        'lawyer_id', 
        'name', 
        'email', 
        'mobile', 
        'country_id', 
        'lang_id', 
        'message', 
        'type',
        'lawyer_type',
        'status',
        'accepted_by',
    ];

    protected $casts = [
        'lawyer_id' => 'array',
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function acceptedBy()
    {
        return $this->belongsTo(Lawyer::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function notifications()
    {
        return $this->hasMany(RequestNotification::class);
    }
    
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y, h:i A'); 
    }
        
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y, h:i A'); 
    }

    public function ratings()
    {
        return $this->hasMany(UserRequestRating::class);
    }
}
