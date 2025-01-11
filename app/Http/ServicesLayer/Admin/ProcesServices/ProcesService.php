<?php

namespace App\Http\ServicesLayer\Admin\ProcesServices;

use App\Models\Process;
use App\Models\ProcesStep;

class ProcesService
{
    protected $model;
    protected $procesStep;

    public function __construct(Process $model, ProcesStep $procesStep)
    {
        $this->model = $model;
        $this->procesStep = $procesStep;
    }

    public function create($request)
    {
        $proces_steps = [];
        foreach ($request['proces_steps'] as $proces_step) {
            $step = new $this->procesStep();
            $step->translateOrNew('ar')->content = $proces_step['content_ar'];
            $step->translateOrNew('en')->content = $proces_step['content_en'];
            $proces_steps[] = $step;
        }
        $proces = $this->model->create($request);
        $proces->steps()->saveMany($proces_steps);
        return $proces;

        // count($request['proces_steps']) > 0 ? $proces->steps()->createMany(array_filter($request['proces_steps'])) : ''; 
        // return $proces;
    }

    public function update($request, $id)
    {

        $proces = $this->model->find($id);
        if(count($request['proces_steps']))
        {
            $proces_steps = [];
            foreach ($request['proces_steps'] as $proces_step) {
                $step = new $this->procesStep();
                $step->translateOrNew('ar')->content = $proces_step['content_ar'];
                $step->translateOrNew('en')->content = $proces_step['content_en'];
                $proces_steps[] = $step;
            }
            $proces->steps()->delete();
            // $proces->steps()->createMany(array_filter($request['proces_steps']));
            $proces->steps()->saveMany(array_filter($proces_steps));
        }
        return $proces;
    }
}