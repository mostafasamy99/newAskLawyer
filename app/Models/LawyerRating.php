<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerRating extends Model
{
    protected $table = 'lawyer_ratings';

    protected $fillable = [
        'user_id', 
        'lawyer_id', 
        'rating', 
        'message', 
    ];
   
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}
