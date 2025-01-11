<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\LawyerRepository;
use App\Http\Requests\LawyerRequests\LawyerStoreRequest;
use App\Http\Requests\LawyerRequests\LawyerUpdateRequest;

class LawyerController extends Controller
{

    public $lawyers;

    public function __construct(LawyerRepository $lawyers)
    {
        $this->lawyers = $lawyers;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->lawyers->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->lawyers->create();
    }

    public function store(LawyerStoreRequest $request)
    {
        try{
            $this->lawyers->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->lawyers->edit($id);
    }

    public function update(LawyerUpdateRequest $request, $id)
    {
        try{
            $this->lawyers->update($request, $id);
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
            $this->lawyers->activate($request->record_id);
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
            $this->lawyers->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->lawyers->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->lawyers->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->lawyers->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->lawyers->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->lawyers->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->lawyers->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->lawyers->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->lawyers->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}
