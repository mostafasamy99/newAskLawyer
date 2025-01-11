<?php

namespace App\Http\ServicesLayer\Front\ContactServices;

use App\Models\Contact;

class ContactService
{
    protected $model;

    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        $request = $this->handle_request($request);
        return $this->model->create($request);
    }    
    
    public function handle_request($request)
    {
        $request = array_filter(array_intersect_key($request->all(), $this->model->fildes()));
        return $request;
    }
}