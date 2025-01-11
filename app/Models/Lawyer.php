<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Lawyer extends Authenticatable 
{
    use HasApiTokens,  Notifiable ;
    protected $table = 'lawyers';
	protected $fillable = [
		'name', 'email', 'img', 'password', 'union_card', 'title', 'country_id', 'city_id', 'lang_id', 'address', 'mobile', 'linked_in', 'file', 'type',
		'registration_number', 'education', 'medals', 'memberships', 'disclaimer', 'lang','address_company',
        'website_company','linked_in_company','city_id_company','country_id_company','office_rent','passport','code','otp_expires_at','rate','name_company','bio_company','card_id_img'
	];
    public $timestamps = true;

	public function scopeActive($query){
		return $query->where('is_activate', 1);
	}

	public function scopeUnActive($query){
		return $query->where('is_activate', 0);
	}

	public function scopeArchive($query){
		return $query->whereNotNull('deleted_at');
	}

	public function scopeUnArchive($query){
		return $query->whereNull('deleted_at');
	}

	public function scopeLawyers($query){
		return $query->where('type', 1);
	}

	public function scopeCompanies($query){
		return $query->where('type', 2);
	}

	public function fildes(){
		return [
			'name' => '', 'email' => '', 'img' => '', 'union_card' => '', 'title' => '', 'country_id' => '', 'city_id' => '', 'lang_id' => '',
			'address' => '', 'password' => '', 'mobile' => '', 'linked_in' => '', 'file' => '', 'type' => '', 'services' => '', 'languages' => '',
			'legal_fields' => '', 'registration_number' => '', 'education' => '', 'medals' => '', 'memberships' => '', 'disclaimer' => '', 'lang' => '',
			'address_company' => '', 'website_company' => '', 'linked_in_company' => '', 'city_id_company' => '', 'country_id_company' => '',
			'office_rent' => '', 'passport' => '', 'code' => ''
		];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('name', 'LIKE', '%'. $query .'%')
					 ->orWhere('email', 'LIKE', '%'. $query .'%')
					 ->orWhere('mobile', 'LIKE', '%'. $query .'%')
					 ->unArchive()->get();
	}

	public function scopeModelSearchInArchives($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('name', 'LIKE', '%'. $query .'%')
					 ->orWhere('email', 'LIKE', '%'. $query .'%')
					 ->orWhere('mobile', 'LIKE', '%'. $query .'%')
					 ->archive()->get();
	}

	public function model_relations()
	{
		return [];
	}

    public function messages()
    {
        return $this->morphMany(Message::class, 'senderable');
    }

    public function rooms()
    {
        return $this->morphMany(RoomMember::class, 'userable');
    }

    public function lang()
    {
        return $this->belongsTo(Language::class, 'lang_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

	public function services()
	{
		return $this->belongsToMany(Service::class, 'lawyer_services');
	}

	public function languages()
	{
		return $this->belongsToMany(Language::class, 'lawyer_languages');
	}

	public function requests()
	{
		return $this->hasMany(Request::class, 'lawyer_id');
	}

	public function legal_fields()
	{
		return $this->belongsToMany(LegalField::class, 'lawyer_legal_fields');
	}

	public function blogs()
    {
        return $this->morphMany(Blog::class, 'blogable');
    }

	public function notifications()
    {
        return $this->morphMany(Notification::class, 'userable');
    }

    public function lawyer_prices()
    {
        return $this->hasMany(LawyerPrices::class, 'lawyer_id');
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

	public static function getActiveLawyerNames()
	{
		return self::lawyers()->active()->get(['id', 'name']); 
	}


	public static function getActiveAdvisorNames()
	{
		return self::where('type', 3)->active()->get(['id', 'name']); // Retrieve both id and name
	}
	public function lawyerAcceptedServices()
	{
		return $this->hasMany(LawyerAcceptedService::class, 'lawyer_id');
	}
	
	
}
