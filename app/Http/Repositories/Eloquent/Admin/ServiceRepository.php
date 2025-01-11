<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\ServiceServices\ServiceService;
use App\Models\Service;
use DevxPackage\AbstractRepository;

class ServiceRepository extends AbstractRepository
{

    protected $model;
    protected $serviceServices;

    public function __construct(Service $model, ServiceService $serviceServices)
    {
        $this->model = $model;
        $this->serviceServices = $serviceServices;
    }

    public function crudName(): string
    {
        return 'services';
    }

    public function index($offset, $limit)
    {
        $services = $this->pagination($offset, $limit);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->serviceServices->create($request, $translations);
    }

    public function edit($id)
    {
        $service = $this->findOne($id);
        return view('admin.services.update', compact('service'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->serviceServices->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $services = $this->archives($offset, $limit);
        return view('admin.services.archives', compact('services'));
    }

}