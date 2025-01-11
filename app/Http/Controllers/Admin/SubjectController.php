<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\SubjectRepository;
use App\Http\Requests\Admin\SubjectRequests\SubjectStoreRequest;
use App\Http\Requests\Admin\SubjectRequests\SubjectUpdateRequest;

class SubjectController extends Controller
{

    public $subjects;

    public function __construct(SubjectRepository $subjects)
    {
        $this->subjects = $subjects;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->subjects->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->subjects->create();
    }

    public function store(SubjectStoreRequest $request)
    {
        try{
            $this->subjects->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->subjects->edit($id);
    }

    public function update(SubjectUpdateRequest $request, $id)
    {
        try{
            $this->subjects->update($request, $id);
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
            $this->subjects->activate($request->record_id);
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
            $this->subjects->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->subjects->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->subjects->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->subjects->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->subjects->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->subjects->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->subjects->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->subjects->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->subjects->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}