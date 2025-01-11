<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\LawyerServices\LawyerService;
use App\Models\Lawyer;
use DevxPackage\AbstractRepository;

class LawyerRepository extends AbstractRepository
{

    protected $model;
    protected $lawyerService;

    public function __construct(Lawyer $model, LawyerService $lawyerService)
    {
        $this->model = $model;
        $this->lawyerService = $lawyerService;
    }

    public function crudName(): string
    {
        return 'lawyers';
    }

    public function index($offset, $limit)
    {
        $lawyers = $this->pagination($offset, $limit);
        return view('admin.lawyers.index', compact('lawyers'));
    }

    public function create()
    {
        return view('admin.lawyers.create');
    }

    public function store($request)
    {
        $request = $this->handle_request($request);
        return $this->lawyerService->store($request);
    }

    public function edit($id)
    {
        $lawyer = $this->findOne($id);
        return view('admin.lawyers.update', compact('lawyer'));
    }

    public function update($request, $id)
    {
        $request = $this->handle_request($request);        
        return $this->lawyerService->update($request, $id);
    }

    public function archivesPage($offset, $limit)
    {
        $lawyers = $this->archives($offset, $limit);
        return view('admin.lawyers.archives', compact('lawyers'));
    }

    public function handle_request($request)
    {
        $request->password ? $request->merge(['password' => bcrypt($request->password)]) : "";
        if (!$request->hasFile('photo') == null) {
            $file = uploadIamge($request->file('photo'), $this->crudName()); // function on helper file to upload file
            $request->merge(['img' => $file]);
        }
        if (!$request->hasFile('photo_union_card') == null) {
            $files = uploadIamge($request->file('photo_union_card'), $this->crudName()); // function on helper file to upload file
            $request->merge(['union_card' => $files]);
        }
        $request = array_filter(array_intersect_key($request->all(), $this->model->fildes()));
        return $request;
    }

}