<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\ServicesLayer\BlogServices\BlogService;
use App\Models\Blog;
use App\Models\Request;
use DevxPackage\AbstractRepository;

class BlogRepository extends AbstractRepository
{

    protected $model;
    protected $blogService;

    public function __construct(Blog $model, BlogService $blogService)
    {
        $this->model = $model;
        $this->blogService = $blogService;
    }

    public function crudName(): string
    {
        return 'blogs';
    }

    public function index($offset, $limit)
    {
        $blogs = $this->pagination($offset, $limit);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function storeBlog($request, $auth, $added_by_type = 1, $isPublish = 1, $is_fixed_service)
    {
        $translations = [
            'title_ar' => $request->title_ar,
            'content_ar' => $request->content_ar,
            'description_ar' => $request->description_ar,
            'title_en' => $request->title_en,
            'content_en' => $request->content_en,
            'description_en' => $request->description_en,
        ];
        $request = $this->handle_request($request);
        $request['is_fixed_service'] = $is_fixed_service;
        return $this->blogService->create($request, $translations, $auth, $added_by_type, $isPublish);
    }

    public function edit($id)
    {
        $blog = $this->findOne($id);
        return view('admin.blogs.update', compact('blog'));
    }

    public function updateBlog($request, $id, $is_fixed_service)
    {
        $translations = [
            'title_ar' => $request->title_ar,
            'content_ar' => $request->content_ar,
            'description_ar' => $request->description_ar,
            'title_en' => $request->title_en,
            'content_en' => $request->content_en,
            'description_en' => $request->description_en,
        ];
        $request = $this->handle_request($request);
        $request['is_fixed_service'] = $is_fixed_service;
        !isset($request['is_favorite']) ? $request['is_favorite'] = 0 : '';
        return $this->blogService->update($id, $request, $translations);
    }

    public function archivesPage($offset, $limit)
    {
        $blogs = $this->archives($offset, $limit);
        return view('admin.blogs.archives', compact('blogs'));
    }

    public function costUpdate($request, $id)
    {
        $request = $this->handle_request($request);
        return $this->blogService->costUpdate($id, $request);
    }

    public function sort($request){
        return $this->update($request, $request->sort_record_id);
    }
}
