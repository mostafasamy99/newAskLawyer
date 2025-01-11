<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Blog extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'blogs';
	protected $fillable = [
		'title', 'content', 'img', 'service_id', 'subject_id', 'section_id', 'added_by_id', 'added_by_type', 'price', 'description', 'is_favorite', 'order', 'is_publish',
		'country_id', 'is_fixed_service'
	];
    protected $appends = ['encrypted_id', 'price_secreen_route'];
    public $timestamps = true;
	public $translatedAttributes = ['title', 'content', 'description'];

    public function getEncryptedIdAttribute()
    {
        return encrypt($this->id);
    }

    public function getPriceSecreenRouteAttribute()
    {
        return route('dashboard/blogs/cost', encrypt($this->id));
    }

	public function scopeFixedService($query){
		return $query->where('added_by_type', 1)->where('is_fixed_service', 1);
	}

	public function scopeLawyerBlogs($query){
		return $query->where('blogable_type', 'App\Models\Lawyer')->where('blogable_id', auth()->guard('lawyer')->user()->id);
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

	public function scopeFavorite($query){
		return $query->where('is_favorite', 1);
	}

	public function scopeBlogTypes($query, int $type){
		return $query->where('added_by_type', $type);
	}

	public function scopePublish($query){
		return $query->where('is_publish', 1);
	}

	public function scopeUnPublish($query){
		return $query->where('is_publish', 0);
	}

	public function fildes(){
		return [
			'title' => '', 'content' => '', 'img' => '', 'service_id' => '', 'subject_id' => '', 'section_id' => '', 'is_favorite' => '', 'order' => '', 'price' => '',
			'description' => '', 'country_id' => ''
		];
	}

	public function scopeModelSearch($model, $query)
	{
		return $model->latest()->where('id', 'LIKE', '%'. $query .'%')
					->orWhereHas('translations', function ($FQuery) use($query) {
						$FQuery->where('locale', 'ar')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('title', 'LIKE', '%' . $query . '%')
							->orWhere('description', 'LIKE', '%' . $query . '%')
							->orWhere('content', 'LIKE', '%' . $query . '%');
						});

					})
					->orWhereHas('translations', function ($SQuery) use($query) {
						$SQuery->where('locale', 'en')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('title', 'LIKE', '%' . $query . '%')
							->orWhere('description', 'LIKE', '%' . $query . '%')
							->orWhere('content', 'LIKE', '%' . $query . '%');
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
							$subSubQuery->where('title', 'LIKE', '%' . $query . '%')
							->orWhere('description', 'LIKE', '%' . $query . '%')
							->orWhere('content', 'LIKE', '%' . $query . '%');
						});

					})
					->orWhereHas('translations', function ($SQuery) use($query) {
						$SQuery->where('locale', 'en')
						->where(function ($subSubQuery) use ($query) {
							$subSubQuery->where('title', 'LIKE', '%' . $query . '%')
							->orWhere('description', 'LIKE', '%' . $query . '%')
							->orWhere('content', 'LIKE', '%' . $query . '%');
						});

					})
					->archive()->get();
	}

	public function model_relations()
	{
		return ['service', 'section', 'country', 'translations'];
	}

	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id');
	}

	public function service()
	{
		return $this->belongsTo(Service::class, 'service_id');
	}

	public function section()
	{
		return $this->belongsTo(Section::class, 'section_id');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class, 'subject_id');
	}

	public function related_blogs()
	{
		return $this->hasMany(self::class, 'section_id', 'section_id')->favorite()->active()->unArchive()->inRandomOrder()->orderBy('order', 'desc')->limit(6);
	}

	public function blogable()
    {
        return $this->morphTo();
    }

	public function notifications()
    {
        return $this->morphMany(Notification::class, 'targetable');
    }

    public function prices()
    {
        return $this->hasMany(LawyerPrices::class, 'blog_id');
    }
}
