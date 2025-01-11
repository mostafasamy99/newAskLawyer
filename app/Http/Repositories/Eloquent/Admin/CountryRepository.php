<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\CountryServices\CountryService;
use App\Models\Country;
use DevxPackage\AbstractRepository;

class CountryRepository extends AbstractRepository
{

    protected $model;
    protected $countryService;

    public function __construct(Country $model, CountryService $countryService)
    {
        $this->model = $model;
        $this->countryService = $countryService;
    }

    public function crudName(): string
    {
        return 'countries';
    }

    public function index($offset, $limit)
    {
        $countries = $this->pagination($offset, $limit);
        return view('admin.countries.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->countryService->create($request, $translations);
    }

    public function edit($id)
    {
        $country = $this->findOne($id);
        return view('admin.countries.update', compact('country'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);        
        return $this->countryService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $countries = $this->archives($offset, $limit);
        return view('admin.countries.archives', compact('countries'));
    }

}