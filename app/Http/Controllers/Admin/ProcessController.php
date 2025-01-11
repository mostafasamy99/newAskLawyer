<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\ProcessRepository;
use App\Http\Requests\Admin\ProcessRequests\ProcessStoreRequest;
use App\Http\Requests\Admin\ProcessRequests\ProcessUpdateRequest;

class ProcessController extends Controller
{

    public $process;

    public function __construct(ProcessRepository $process)
    {
        $this->process = $process;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->process->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->process->create();
    }

    public function store(ProcessStoreRequest $request)
    {
        try{
            $this->process->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->process->edit($id);
    }

    public function update(ProcessUpdateRequest $request, $id)
    {
        try{
            $this->process->update($request, $id);
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
            $this->process->activate($request->record_id);
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
            $this->process->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->process->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->process->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->process->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->process->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->process->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->process->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->process->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->process->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}