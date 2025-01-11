<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\CountryRepository;
use App\Http\Requests\Admin\CountryRequests\CountryStoreRequest;
use App\Http\Requests\Admin\CountryRequests\CountryUpdateRequest;

class CountryController extends Controller
{

    public $countries;

    public function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->countries->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->countries->create();
    }

    public function store(CountryStoreRequest $request)
    {
        try{
            $this->countries->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->countries->edit($id);
    }

    public function update(CountryUpdateRequest $request, $id)
    {
        try{
            $this->countries->update($request, $id);
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
            $this->countries->activate($request->record_id);
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
            $this->countries->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->countries->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->countries->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->countries->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->countries->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->countries->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->countries->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->countries->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->countries->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}