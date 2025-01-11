<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class About extends Model implements TranslatableContract
{
    use Translatable;
	
    protected $table = 'abouts';
	protected $fillable = ['img', 'img_dir', 'about_type'];
    public $timestamps = true;
	public $translatedAttributes = ['content'];
	protected $appends = ['about_type_name'];
	
	public function getAboutTypeNameAttribute()
    {
        if ($this->about_type == 0) { return "عن الشركة"; } 
        else if ($this->about_type == 1) { return "الرئيسيه"; } 
		else if ($this->about_type == 2) { return "اسال محامي"; }
		else if ($this->about_type == 3) { return "لماذا يختارنا العملاء ؟"; }
		else if ($this->about_type == 4) { return "سير العملية للوكلاء"; }
		else if ($this->about_type == 5) { return "سياسة الخصوصية"; }
    }

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
	
	public function scopeAboutTypes($query, int $type){
		return $query->where('about_type', $type);
	}
	
	public function fildes(){
		return ['content' => '', 'img' => '', 'img_dir' => '', 'about_type' => ''];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					->orWhereHas('translations', function ($FQuery) use($query) {
						$FQuery->where('locale', 'ar')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('content', 'LIKE', '%' . $query . '%');
						});

					})
					->orWhereHas('translations', function ($SQuery) use($query) {
						$SQuery->where('locale', 'en')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('content', 'LIKE', '%' . $query . '%');
						});

					})
					->unArchive()->get();
	}

	public function scopeModelSearchInArchives($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					->orwhereHas('translations', function ($FQuery) use($query) {
						$FQuery->where('locale', 'ar')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('content', 'LIKE', '%' . $query . '%');
						});

					})
					->orWhereHas('translations', function ($SQuery) use($query) {
						$SQuery->where('locale', 'en')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('content', 'LIKE', '%' . $query . '%');
						});

					})
					->archive()->get();
	}

	public function model_relations()
	{
		return [];
	}
}