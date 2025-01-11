<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;

class City extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'cities';
	protected $fillable = ['country_id'];
    public $timestamps = true;
	public $translatedAttributes = ['name'];

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
		return ['name'  => '', 'country_id'  => ''];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					->orWhereHas('translations', function ($FQuery) use($query) {
						$FQuery->where('locale', 'ar')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('name', 'LIKE', '%' . $query . '%');
						});

					})
					->orWhereHas('translations', function ($SQuery) use($query) {
						$SQuery->where('locale', 'en')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('name', 'LIKE', '%' . $query . '%');
						});

					})
					->unArchive()->get();
	}

	public function scopeModelSearchInArchives($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					->orWhereHas('translations', function ($FQuery) use($query) {
						$FQuery->where('locale', 'ar')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('name', 'LIKE', '%' . $query . '%');
						});

					})
					->orWhereHas('translations', function ($SQuery) use($query) {
						$SQuery->where('locale', 'en')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('name', 'LIKE', '%' . $query . '%');
						});

					})
					->archive()->get();
	}

	public function model_relations()
	{
		return ['country'];
	}

	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id');	
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