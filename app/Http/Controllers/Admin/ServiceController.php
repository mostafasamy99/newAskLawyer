<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\ServiceRepository;
use App\Http\Requests\Admin\ServiceRequests\ServiceStoreRequest;
use App\Http\Requests\Admin\ServiceRequests\ServiceUpdateRequest;

class ServiceController extends Controller
{

    public $services;

    public function __construct(ServiceRepository $services)
    {
        $this->services = $services;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->services->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->services->create();
    }

    public function store(ServiceStoreRequest $request)
    {
        try{
            $this->services->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->services->edit($id);
    }

    public function update(ServiceUpdateRequest $request, $id)
    {
        try{
            $this->services->update($request, $id);
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
            $this->services->activate($request->record_id);
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
            $this->services->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->services->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->services->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->services->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->services->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->services->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->services->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->services->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->services->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}