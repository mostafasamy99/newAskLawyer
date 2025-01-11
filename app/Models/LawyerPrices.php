<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawyerPrices extends Model
{
    use HasFactory;

    protected $table = 'lawyer_prices';
    public $timestamps = true;
    protected $fillable = [
        'lawyer_id','blog_id','price'
	];

    public function fildes(){
        return [
			'lawyer_id' => '', 'blog_id' => '', 'price' => ''
		];
	}

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id')->with('translations');
    }
}
