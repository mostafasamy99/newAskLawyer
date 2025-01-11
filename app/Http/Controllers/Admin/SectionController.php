<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\SectionRepository;
use App\Http\Requests\Admin\SectionRequests\SectionStoreRequest;
use App\Http\Requests\Admin\SectionRequests\SectionUpdateRequest;

class SectionController extends Controller
{

    public $sections;

    public function __construct(SectionRepository $sections)
    {
        $this->sections = $sections;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->sections->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->sections->create();
    }

    public function store(SectionStoreRequest $request)
    {
        try{
            $this->sections->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->sections->edit($id);
    }

    public function update(SectionUpdateRequest $request, $id)
    {
        try{
            $this->sections->update($request, $id);
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
            $this->sections->activate($request->record_id);
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
            $this->sections->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->sections->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->sections->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->sections->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->sections->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->sections->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->sections->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->sections->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->sections->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}