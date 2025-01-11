<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;

class PlatformService extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = 'platform_services';

    protected $fillable = ['icon', 'price','max_price', 'legal_field_id'];

    public $timestamps = true;

    public $translatedAttributes = ['name', 'description'];

    protected $translationForeignKey = 'platform_services_id';

    /**
     * Fields with default values for quick reference.
     */
    public function fildes()
    {
        return [
            'name' => '',
            'description' => '',
            'icon' => '',
            'price' => '',
            'max_price' => '',
            'legal_field_id' => '',
        ];
    }

    /**
     * Search across the model and its translations.
     */
    public function scopeModelSearch($model, $query)
    {
        return $model->latest()
            ->where('id', 'LIKE', '%' . $query . '%')
            ->orWhereHas('translations', function ($FQuery) use ($query) {
                $FQuery->where('locale', 'ar')
                    ->where(function ($subSubQuery) use ($query) {
                        $subSubQuery->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%');
                    });
            })
            ->orWhereHas('translations', function ($SQuery) use ($query) {
                $SQuery->where('locale', 'en')
                    ->where(function ($subSubQuery) use ($query) {
                        $subSubQuery->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%');
                    });
            })
            ->unArchive()->get();
    }

    public function scopeModelSearchInArchives($model, $query)
    {
        return $model->latest()
            ->where('id', 'LIKE', '%' . $query . '%')
            ->orWhereHas('translations', function ($FQuery) use ($query) {
                $FQuery->where('locale', 'ar')
                    ->where(function ($subSubQuery) use ($query) {
                        $subSubQuery->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%');
                    });
            })
            ->orWhereHas('translations', function ($SQuery) use ($query) {
                $SQuery->where('locale', 'en')
                    ->where(function ($subSubQuery) use ($query) {
                        $subSubQuery->where('name', 'LIKE', '%' . $query . '%')
                            ->orWhere('description', 'LIKE', '%' . $query . '%');
                    });
            })
            ->archive()->get();
    }

    /**
     * Define model relations.
     */
    public function model_relations()
    {
        return [];
    }

    /**
     * Relationship with LegalField model.
     */
    public function legalField()
    {
        return $this->belongsTo(LegalField::class, 'legal_field_id');
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

    public function lawyerAcceptedServices()
    {
        return $this->hasMany(LawyerAcceptedService::class, 'platform_service_id');
    }

}
