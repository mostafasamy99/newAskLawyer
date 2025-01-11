<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}