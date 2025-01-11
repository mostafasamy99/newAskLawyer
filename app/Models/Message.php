<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
	protected $fillable = [
        'body',
        'room_id',
        'senderable',
        'receiverable',
        'read_at',
        'receiver_deleted_at',
        'sender_deleted_at',
		'senderable_type',
		'senderable_id',
		'receiverable_type',
		'receiverable_id',
		'request_id',
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

	public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

	public function sender()
    {
        return $this->belongsTo(Room::class);
    }

	public function receiver()
    {
        return $this->belongsTo(Room::class);
    }

	public function senderable()
    {
        return $this->morphTo();
    }

	public function receiverable()
    {
        return $this->morphTo();
    }
}