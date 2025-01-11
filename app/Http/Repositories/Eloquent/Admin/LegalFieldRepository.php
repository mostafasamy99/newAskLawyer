<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\LegalFieldServices\LegalFieldService;
use App\Models\LegalField;
use DevxPackage\AbstractRepository;

class LegalFieldRepository extends AbstractRepository
{

    protected $model;
    protected $legalFieldService;

    public function __construct(LegalField $model, LegalFieldService $legalFieldService)
    {
        $this->model = $model;
        $this->legalFieldService = $legalFieldService;
    }

    public function crudName(): string
    {
        return 'legalFields';
    }

    public function index($offset, $limit)
    {
        $legalFields = $this->pagination($offset, $limit);
        return view('admin.legalFields.index', compact('legalFields'));
    }

    public function create()
    {
        return view('admin.legalFields.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->legalFieldService->create($request, $translations);
    }

    public function edit($id)
    {
        $legalField = $this->findOne($id);
        return view('admin.legalFields.update', compact('legalField'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->legalFieldService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $legalFields = $this->archives($offset, $limit);
        return view('admin.legalFields.archives', compact('legalFields'));
    }

}