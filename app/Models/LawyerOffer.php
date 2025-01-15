<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LawyerOffer extends Model
{
    protected $table = 'lawyer_offers';

    protected $fillable = [
        'request_id',
        'lawyer_id',
        'price',
        'message',
        'is_rejected',
        'accepted_by',
        'status'
    ];

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id');
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by');
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
