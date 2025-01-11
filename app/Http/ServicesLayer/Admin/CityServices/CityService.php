<?php

namespace App\Http\ServicesLayer\Admin\CityServices;

use App\Models\City;

class CityService
{
    protected $model;

    public function __construct(City $model)
    {
        $this->model = $model;
    }

    public function create($request, $translations)
    {
        $model = $this->model->create($request);
        $model->translateOrNew('ar')->name = $translations['name_ar'];
        $model->translateOrNew('en')->name = $translations['name_en'];
        return $model->save();
    }

    public function update($request, $id, $translations)
    {
        $model = $this->model->find($id);
        $model->update($request); 
        $model->translateOrNew('ar')->name = $translations['name_ar'];
        $model->translateOrNew('en')->name = $translations['name_en'];
        return $model->save();
    }

    public function country_cities($request)
    {
        $query = $request->get('q');
        $country = $request->get('country');
        $records = [];
        
        if( !is_null($country) ){
            $records = $this->model->with($this->model->model_relations())
            ->where('country_id', $country)
            ->when($query, function ($q) use ($query) {
                $q->latest()->where('id', 'LIKE', '%'. $query .'%')
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

                });
            })
            ->unArchive()->get();
        }
        return $records;
    }
}