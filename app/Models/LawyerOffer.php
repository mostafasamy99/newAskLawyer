<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
