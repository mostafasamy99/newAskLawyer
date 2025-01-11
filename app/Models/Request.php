<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Request extends Model
{
    protected $table = 'requests';
	protected $fillable = ['username', 'first_name', 'last_name', 'title', 'mobile', 'email', 'message','summary','status', 'files', 'request_id', 'service_id', 'user_id', 'lawyer_id', 'country_id', 'blog_id', 'is_read', 'fixed_service_price'];
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

	public function fildes(){
		return [
			'username' => '', 'first_name' => '', 'last_name' => '', 'title' => '', 'mobile' => '', 'email' => '', 'message' => '', 'request_id' => '',
			'service_id' => '', 'files' => '', 'user_id' => '', 'lawyer_id' => '', 'blog_id' => '', 'country_id' => '', 'fixed_service_price' => ''
		];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('username', 'LIKE', '%'. $query .'%')
					 ->orWhere('mobile', 'LIKE', '%'. $query .'%')
					 ->orWhere('email', 'LIKE', '%'. $query .'%')
					 ->orWhere('message', 'LIKE', '%'. $query .'%')
					 ->orWhere('title', 'LIKE', '%'. $query .'%')
					 ->unArchive()->get();
	}

	public function scopeModelSearchInArchives($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('username', 'LIKE', '%'. $query .'%')
					 ->orWhere('mobile', 'LIKE', '%'. $query .'%')
					 ->orWhere('email', 'LIKE', '%'. $query .'%')
					 ->orWhere('message', 'LIKE', '%'. $query .'%')
					 ->orWhere('title', 'LIKE', '%'. $query .'%')
					 ->archive()->get();
	}

	public function model_relations()
	{
		return [];
	}

	public function lawyer()
	{
		return $this->belongsTo(Lawyer::class, 'lawyer_id');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'service_id');
	}

	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function messages()
	{
		return $this->hasMany(Message::class, 'request_id');
	}

	public function answers()
	{
		return $this->hasMany(Answer::class, 'request_id');
	}

	public function answer()
	{
		return $this->hasOne(Answer::class, 'request_id')->whereLawyer_id(auth()->guard('lawyer')->user()->id)->orderBy('id', 'desc');
	}

	public function notifications()
    {
        return $this->hasMany(RequestNotification::class);
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
