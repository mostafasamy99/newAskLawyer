<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformServiceTranslation extends Model
{
    protected $table = 'platform_service_translations';
    public $timestamps = false;
    protected $fillable = ['name','description','locale'];

    public function platformService()
    {
        return $this->belongsTo(PlatformService::class, 'platform_services_id');
    }
    
}
