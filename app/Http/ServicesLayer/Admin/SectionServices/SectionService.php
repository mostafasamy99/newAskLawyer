<?php

namespace App\Http\ServicesLayer\Admin\SectionServices;

use App\Models\Section;

class SectionService
{
    protected $model;

    public function __construct(Section $model) 
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
}