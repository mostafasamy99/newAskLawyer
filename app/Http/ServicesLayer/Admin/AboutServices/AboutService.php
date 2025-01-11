<?php

namespace App\Http\ServicesLayer\Admin\AboutServices;

use App\Models\About;

class AboutService
{
    protected $model;

    public function __construct(About $model)
    {
        $this->model = $model;
    }

    public function create($request, $translations)
    {
        $model = $this->model->create($request);
        $model->translateOrNew('ar')->content = $translations['content_ar'];
        $model->translateOrNew('en')->content = $translations['content_en'];
        return $model->save();
    }

    public function update($request, $id, $translations)
    {
        $model = $this->model->find($id);
        $model->update($request);
        $model->translateOrNew('ar')->content = $translations['content_ar'];
        $model->translateOrNew('en')->content = $translations['content_en'];
        return $model->save();
    }
}