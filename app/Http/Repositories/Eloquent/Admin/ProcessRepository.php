<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\ProcesServices\ProcesService;
use App\Models\Process;
use DevxPackage\AbstractRepository;

class ProcessRepository extends AbstractRepository
{

    protected $model;
    protected $procesService;

    public function __construct(Process $model, ProcesService $procesService)
    {
        $this->model = $model;
        $this->procesService = $procesService;
    }

    public function crudName(): string
    {
        return 'process';
    }

    public function index($offset, $limit)
    {
        $process = $this->pagination($offset, $limit);
        return view('admin.process.index', compact('process'));
    }

    public function create()
    {
        return view('admin.process.create');
    }

    public function store($request)
    {
        $request = $this->handle_request($request);
        return $this->procesService->create($request);
    }

    public function edit($id)
    {
        $process = $this->findOne($id);
        return view('admin.process.update', compact('process'));
    }

    public function update($request, $id)
    {
        $request = $this->handle_request($request);        
        return $this->procesService->update($request, $id);
    }


    public function archivesPage($offset, $limit)
    {
        $process = $this->archives($offset, $limit);
        return view('admin.process.archives', compact('process'));
    }
        
    public function search($request)
    {
        $query = $request->get('q');
        $records = [];
        if( !is_null($query) ){
            $searchButton = 0;
            $records = $this->model->with($this->model->model_relations())
                            ->whereHas('translations', function ($FQuery) use($query) {
                                $FQuery->where('locale', 'ar')
                                ->where(function ($subSubQuery) use ($query) {
                                    $subSubQuery->where('content', 'LIKE', '%' . $query . '%');
                                });
                            })
                            ->orWhereHas('translations', function ($SQuery) use($query) {
                                $SQuery->where('locale', 'en')
                                ->where(function ($subSubQuery) use ($query) {
                                    $subSubQuery->where('content', 'LIKE', '%' . $query . '%');
                                });
                            })
                            ->unArchive()->get();
        }else{
            $searchButton = 1;
            $records = $this->model->latest()->with($this->model->model_relations())->unArchive()->limit(PAGINATION_COUNT)->get(); 
        }
        if($records && count($records) > 0){
            $records[0]->searchButton = $searchButton;
        }
        return $records;
    }

}