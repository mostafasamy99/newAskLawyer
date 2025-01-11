<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\SubjectServices\SubjectService;
use App\Models\Subject;
use DevxPackage\AbstractRepository;

class SubjectRepository extends AbstractRepository
{

    protected $model;
    protected $subjectService;

    public function __construct(Subject $model, SubjectService $subjectService)
    {
        $this->model = $model;
        $this->subjectService = $subjectService;
    }

    public function crudName(): string
    {
        return 'subjects';
    }

    public function index($offset, $limit)
    {
        $subjects = $this->pagination($offset, $limit);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->subjectService->create($request, $translations);
    }

    public function edit($id)
    {
        $subject = $this->findOne($id);
        return view('admin.subjects.update', compact('subject'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->subjectService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $subjects = $this->archives($offset, $limit);
        return view('admin.subjects.archives', compact('subjects'));
    }

}