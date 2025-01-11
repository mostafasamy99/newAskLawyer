<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
	protected $fillable = ['name'];
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
		return ['name'  => ''];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('name', 'LIKE', '%'. $query .'%')
					 ->unArchive()->get();
	}

	public function scopeModelSearchInArchives($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					 ->orWhere('name', 'LIKE', '%'. $query .'%')
					 ->archive()->get();
	}

	public function model_relations()
	{
		return [];
	}

	public function messages()
    {
        return $this->hasMany(Message::class, 'room_id');
    }

	public function members()
    {
        return $this->hasMany(RoomMember::class, 'room_id');
    }
}