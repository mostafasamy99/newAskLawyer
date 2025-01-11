<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\LanguageServices\LanguageService;
use App\Models\Language;
use DevxPackage\AbstractRepository;

class LanguageRepository extends AbstractRepository
{

    protected $model;
    protected $languageService;

    public function __construct(Language $model, LanguageService $languageService)
    {
        $this->model = $model;
        $this->languageService = $languageService;
    }

    public function crudName(): string
    {
        return 'languages';
    }

    public function index($offset, $limit)
    {
        $languages = $this->pagination($offset, $limit);
        return view('admin.languages.index', compact('languages'));
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store($request)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->languageService->create($request, $translations);
    }

    public function edit($id)
    {
        $language = $this->findOne($id);
        return view('admin.languages.update', compact('language'));
    }

    public function update($request, $id)
    {
        $translations = [
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
        ];
        $request = $this->handle_request($request);
        return $this->languageService->update($request, $id, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $languages = $this->archives($offset, $limit);
        return view('admin.languages.archives', compact('languages'));
    }

}