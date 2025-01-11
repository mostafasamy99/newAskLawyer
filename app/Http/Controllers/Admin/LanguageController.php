<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\LanguageRepository;
use App\Http\Requests\Admin\LanguageRequests\LanguageStoreRequest;
use App\Http\Requests\Admin\LanguageRequests\LanguageUpdateRequest;

class LanguageController extends Controller
{

    public $languages;

    public function __construct(LanguageRepository $languages)
    {
        $this->languages = $languages;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->languages->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->languages->create();
    }

    public function store(LanguageStoreRequest $request)
    {
        try{
            $this->languages->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->languages->edit($id);
    }

    public function update(LanguageUpdateRequest $request, $id)
    {
        try{
            $this->languages->update($request, $id);
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
            $this->languages->activate($request->record_id);
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
            $this->languages->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->languages->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->languages->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->languages->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->languages->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->languages->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->languages->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->languages->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->languages->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}