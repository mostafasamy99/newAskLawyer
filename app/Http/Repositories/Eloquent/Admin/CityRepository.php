<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\CityServices\CityService;
use App\Models\City;
use DevxPackage\AbstractRepository;

class CityRepository extends AbstractRepository
{

    protected $model;
    protected $cityService;

    public function __construct(City $model, CityService $cityService)
    {
        $this->model = $model;
        $this->cityService = $cityService;
    }

    public function crudName(): string
    {
        return 'cities';
    }

    public function index($offset, $limit)
    {
        $cities = $this->pagination($offset, $limit);
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->cityService->create($request, $translations);
    }

    public function edit($id)
    {
        $city = $this->findOne($id);
        return view('admin.cities.update', compact('city'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->cityService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $cities = $this->archives($offset, $limit);
        return view('admin.cities.archives', compact('cities'));
    }

    public function country_cities($request)
    {
        return $this->cityService->country_cities($request);
    }

}