<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'title',
        'mobile',
        'address',
        'img',
        'country_id',
        'city_id',
        'code',
        'token',
        'deleted_at',
        'is_activate',
        'report_id',
        'mobile',
        'otp_expires_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
            'name' => '',
            'email' => '',
            'password' => '',
            'title' => '',
            'mobile' => '',
            'address' => '',
            'img' => '',
            'country_id' => '',
            'city_id' => '',
        ];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('email', 'LIKE', '%'. $query .'%')
					 ->orWhere('name', 'LIKE', '%'. $query .'%')
					 ->orWhere('mobile', 'LIKE', '%'. $query .'%')
					 ->orWhere('address', 'LIKE', '%'. $query .'%')
					 ->orWhere('title', 'LIKE', '%'. $query .'%')
					 ->unArchive()->get();
	}

	public function scopeModelSearchInArchives($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('email', 'LIKE', '%'. $query .'%')
					 ->orWhere('name', 'LIKE', '%'. $query .'%')
					 ->orWhere('mobile', 'LIKE', '%'. $query .'%')
					 ->orWhere('address', 'LIKE', '%'. $query .'%')
					 ->orWhere('title', 'LIKE', '%'. $query .'%')
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

	public function requests()
	{
		return $this->hasMany(Request::class, 'user_id');
	}

	public function notifications()
    {
        return $this->morphMany(Notification::class, 'userable');
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
