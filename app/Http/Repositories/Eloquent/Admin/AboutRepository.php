<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\AboutServices\AboutService;
use App\Models\About;
use DevxPackage\AbstractRepository;

class AboutRepository extends AbstractRepository
{

    protected $model;
    protected $aboutService;

    public function __construct(About $model, AboutService $aboutService)
    {
        $this->model = $model;
        $this->aboutService = $aboutService;
    }

    public function crudName(): string
    {
        return 'abouts';
    }

    public function index($offset, $limit)
    {
        $abouts = $this->pagination($offset, $limit);
        return view('admin.abouts.index', compact('abouts'));
    }

    public function create()
    {
        return view('admin.abouts.create');
    }

    public function store($request)
    {
        $translations = [
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
        ];
        $request = $this->handle_request($request);
        return $this->aboutService->create($request, $translations);
    }

    public function edit($id)
    {
        $about = $this->findOne($id);
        return view('admin.abouts.update', compact('about'));
    }

    public function update($request, $id)
    {
        $translations = [
            'content_ar' => $request->content_ar,
            'content_en' => $request->content_en,
        ];
        $request = $this->handle_request($request);
        return $this->aboutService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $abouts = $this->archives($offset, $limit);
        return view('admin.abouts.archives', compact('abouts'));
    }

}