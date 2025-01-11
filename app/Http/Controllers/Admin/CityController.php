<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\CityRepository;
use App\Http\Requests\Admin\CityRequests\CityStoreRequest;
use App\Http\Requests\Admin\CityRequests\CityUpdateRequest;

class CityController extends Controller
{

    public $cities;

    public function __construct(CityRepository $cities)
    {
        $this->cities = $cities;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->cities->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->cities->create();
    }

    public function store(CityStoreRequest $request)
    {
        try{
            $this->cities->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->cities->edit($id);
    }

    public function update(CityUpdateRequest $request, $id)
    {
        try{
            $this->cities->update($request, $id);
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
            $this->cities->activate($request->record_id);
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
            $this->cities->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->cities->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->cities->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->cities->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->cities->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->cities->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->cities->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->cities->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->cities->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}