<?php

namespace App\Http\ServicesLayer\Admin\LawyerServices;

use App\Models\Lawyer;

class LawyerService
{
    protected $model;

    public function __construct(Lawyer $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        $lawyer = $this->model->create($request);
        count($request['services']) > 0 ? $lawyer->services()->attach($request['services']) : ''; 
        count($request['languages']) > 0 ? $lawyer->languages()->attach($request['languages']) : ''; 
        count($request['legal_fields']) > 0 ? $lawyer->legal_fields()->attach($request['legal_fields']) : ''; 
        return $lawyer;
    }

    public function update($request, $id)
    {
        $lawyer = $this->model->find($id);
        if ($lawyer) {
            $lawyer->update($request);
            count($request['services']) > 0 ? $lawyer->services()->sync($request['services']) : ''; 
            count($request['languages']) > 0 ? $lawyer->languages()->sync($request['languages']) : ''; 
            count($request['legal_fields']) > 0 ? $lawyer->legal_fields()->sync($request['legal_fields']) : ''; 
        }
        return $lawyer;
    }
}