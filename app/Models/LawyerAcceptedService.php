<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LawyerAcceptedService extends Model
{
    protected $table = 'lawyer_accepted_services';
	protected $fillable = [
        'price',
        'is_active',
        'lawyer_id',
        'platform_service_id'
    ];
    public $timestamps = true;
	public $translatedAttributes = ['name'];

	public function scopeActive($query){
		return $query->where('is_activate', 1);
	}
	
	public function scopeUnActive($query){
		return $query->where('is_activate', 0);
	}

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function platformService()
    {
        return $this->belongsTo(PlatformService::class, 'platform_service_id');
    }
    // Format created_at
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y, h:i A'); 
    }
            
    // Format updated_at
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d M Y, h:i A'); 
    }
}
