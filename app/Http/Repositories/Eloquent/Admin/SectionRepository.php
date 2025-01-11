<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\SectionServices\SectionService;
use App\Models\Section;
use DevxPackage\AbstractRepository;

class SectionRepository extends AbstractRepository
{

    protected $model;
    protected $sectionService;

    public function __construct(Section $model, SectionService $sectionService)
    {
        $this->model = $model;
        $this->sectionService = $sectionService;
    }

    public function crudName(): string
    {
        return 'sections';
    }

    public function index($offset, $limit)
    {
        $sections = $this->pagination($offset, $limit);
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->sectionService->create($request, $translations);
    }

    public function edit($id)
    {
        $section = $this->findOne($id);
        return view('admin.sections.update', compact('section'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->sectionService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $sections = $this->archives($offset, $limit);
        return view('admin.sections.archives', compact('sections'));
    }

}