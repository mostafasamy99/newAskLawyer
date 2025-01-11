<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
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

	public function settings()
	{
		return $this->hasOne(Setting::class, 'report_id');
	}

	public function requests()
	{
		return $this->hasMany(Request::class, 'report_id')->active()->unArchive();
	}

	public function abouts()
	{
		return $this->hasMany(About::class, 'report_id')->active()->unArchive();
	}

	public function services()
	{
		return $this->hasMany(Service::class, 'report_id')->active()->unArchive();
	}

	public function service()
	{
		return $this->hasOne(Service::class, 'report_id')->active()->unArchive();
	}

	public function about_company()
	{
		return $this->hasOne(About::class, 'report_id')->active()->unArchive()->aboutTypes(1)->orderBy('id', 'desc');
	}

	public function ask_lawyer()
	{
		return $this->hasOne(About::class, 'report_id')->active()->unArchive()->aboutTypes(2)->orderBy('id', 'desc');
	}

	public function privacy_policy()
	{
		return $this->hasOne(About::class, 'report_id')->active()->unArchive()->aboutTypes(5)->orderBy('id', 'desc');
	}

	public function sections_abouts()
	{
		return $this->hasMany(About::class, 'report_id')->active()->unArchive()->aboutTypes(0)->orderBy('id', 'asc')->limit(4);
	}

	public function why_us_abouts()
	{
		return $this->hasMany(About::class, 'report_id')->active()->unArchive()->aboutTypes(3)->orderBy('id', 'desc')->limit(4);
	}

	public function sections_user_process()
	{
		return $this->hasMany(About::class, 'report_id')->active()->unArchive()->aboutTypes(4)->orderBy('id', 'desc')->latest();
	}

	public function blogs()
	{
		return $this->hasMany(Blog::class, 'report_id')->active()->publish()->unArchive()->with('translations');
	}

	public function blogs_fixed_service()
	{
		return $this->hasMany(Blog::class, 'report_id')->active()->publish()->fixedService()->unArchive()->with('translations');
	}

	public function blog()
	{
		return $this->hasOne(Blog::class, 'report_id')->active()->publish()->unArchive()->with('translations');
	}

	public function our_blogs()
	{
		return $this->hasMany(Blog::class, 'report_id')->favorite()->publish()->blogTypes(1)->active()->unArchive()->orderBy('order', 'desc')->with('translations')->limit(30);
	}

	public function lawyers_blogs()
	{
		return $this->hasMany(Blog::class, 'report_id')->favorite()->publish()->blogTypes(2)->active()->unArchive()->orderBy('order', 'desc')->with('translations')->limit(30);
	}

	public function our_blogs_home()
	{
		return $this->hasMany(Blog::class, 'report_id')->favorite()->publish()->blogTypes(1)->active()->unArchive()->orderBy('order', 'desc')->with('translations')->limit(4);
	}

	public function lawyers_blogs_home()
	{
		return $this->hasMany(Blog::class, 'report_id')->favorite()->publish()->blogTypes(2)->active()->unArchive()->orderBy('order', 'desc')->with('translations')->limit(4);
	}

	public function lawyers()
	{
		return $this->hasMany(Lawyer::class, 'report_id')->active()->unArchive()->lawyers();
	}

	public function lawyer_or_company()
	{
		return $this->hasOne(Lawyer::class, 'report_id')->active()->unArchive();
	}

	public function lawyer()
	{
		return $this->hasOne(Lawyer::class, 'report_id')->active()->unArchive()->lawyers();
	}

	public function user()
	{
		return $this->hasOne(User::class, 'report_id')->active()->unArchive();
	}

	public function companies()
	{
		return $this->hasMany(Lawyer::class, 'report_id')->active()->unArchive()->companies();
	}

	public function company()
	{
		return $this->hasOne(Lawyer::class, 'report_id')->active()->unArchive()->companies();
	}

	public function process()
	{
		return $this->hasOne(Process::class, 'report_id')->active()->unArchive()->orderBy('id', 'desc')->latest();
	}

	public function subjects()
	{
		return $this->hasMany(Subject::class, 'report_id')->active()->unArchive()->orderBy('id', 'desc')->limit(4);
	}

	public function subject()
	{
		return $this->hasOne(Subject::class, 'report_id')->active()->unArchive()->orderBy('id', 'desc');
	}

	public function lawyer_notifi_read()
	{
		return $this->hasMany(Notification::class, 'report_id')->lawyers()->read()->orderBy('id', 'desc');
	}

	public function lawyer_notifi_unread()
	{
		return $this->hasMany(Notification::class, 'report_id')->lawyers()->unRead()->orderBy('id', 'desc');
	}

	public function user_notifi_read()
	{
		return $this->hasMany(Notification::class, 'report_id')->users()->read()->orderBy('id', 'desc');
	}

	public function user_notifi_unread()
	{
		return $this->hasMany(Notification::class, 'report_id')->users()->unRead()->orderBy('id', 'desc');
	}
}
