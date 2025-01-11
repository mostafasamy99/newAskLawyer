<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{	
    protected $table = 'notifications';
	protected $fillable = ['content', 'type', 'is_read'];
    public $timestamps = true;
	
	public function fildes(){
		return ['content' => ''];
	}

	public function scopeLawyers($query){
		return $query->where('type', 1);
	}

	public function scopeUsers($query){
		return $query->where('type', 2);
	}

	public function scopeRead($query){
		return $query->where('is_read', 1);
	}

	public function scopeUnRead($query){
		return $query->where('is_read', 0);
	}

	public function userable()
    {
        return $this->morphTo();
    }

	public function targetable()
    {
        return $this->morphTo();
    }
}