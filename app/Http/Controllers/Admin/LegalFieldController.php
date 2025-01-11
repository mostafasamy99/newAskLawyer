<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\LegalFieldRepository;
use App\Http\Requests\Admin\LegalFieldRequests\LegalFieldStoreRequest;
use App\Http\Requests\Admin\LegalFieldRequests\LegalFieldUpdateRequest;

class LegalFieldController extends Controller
{

    public $legalFields;

    public function __construct(LegalFieldRepository $legalFields)
    {
        $this->legalFields = $legalFields;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->legalFields->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->legalFields->create();
    }

    public function store(LegalFieldStoreRequest $request)
    {
        try{
            $this->legalFields->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->legalFields->edit($id);
    }

    public function update(LegalFieldUpdateRequest $request, $id)
    {
        try{
            $this->legalFields->update($request, $id);
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
            $this->legalFields->activate($request->record_id);
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
            $this->legalFields->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->legalFields->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->legalFields->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->legalFields->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->legalFields->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->legalFields->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->legalFields->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->legalFields->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->legalFields->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}