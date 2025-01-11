<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Subject extends Model implements TranslatableContract
{
    use Translatable;
	
    protected $table = 'subjects';
	protected $fillable = ['icon'];
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
		return ['name' => '', 'icon' => ''];
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
		return [];
	}

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'subject_id')->active()->unArchive()->inRandomOrder()->orderBy('order', 'desc')->limit(15);
	}
}