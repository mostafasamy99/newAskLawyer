<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\ProcesStepRepository;
use App\Http\Requests\Admin\ProcesStepRequests\ProcesStepStoreRequest;
use App\Http\Requests\Admin\ProcesStepRequests\ProcesStepUpdateRequest;

class ProcesStepController extends Controller
{

    public $procesSteps;

    public function __construct(ProcesStepRepository $procesSteps)
    {
        $this->procesSteps = $procesSteps;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->procesSteps->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->procesSteps->create();
    }

    public function store(ProcesStepStoreRequest $request)
    {
        try{
            $this->procesSteps->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->procesSteps->edit($id);
    }

    public function update(ProcesStepUpdateRequest $request, $id)
    {
        try{
            $this->procesSteps->update($request, $id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function activate(Request $request)
    {
        try{
            $this->procesSteps->activate($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function delete(Request $request)
    {
        try{
            $this->procesSteps->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->procesSteps->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->procesSteps->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->procesSteps->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->procesSteps->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->procesSteps->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->procesSteps->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->procesSteps->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->procesSteps->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}