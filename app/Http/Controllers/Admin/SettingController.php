<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\SettingRepository;
use App\Http\Requests\Admin\SettingRequests\SettingStoreRequest;
use App\Http\Requests\Admin\SettingRequests\SettingUpdateRequest;

class SettingController extends Controller
{

    public $settings;

    public function __construct(SettingRepository $settings)
    {
        $this->settings = $settings;
    }

    public function index()
    {
        try{
            return $this->settings->editSetting();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->settings->create();
    }

    public function store(SettingStoreRequest $request)
    {
        try{
            $this->settings->store($request);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->settings->edit($id);
    }

    public function update(SettingUpdateRequest $request, $id)
    {
        try{
            $this->settings->update($request, $id);
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
            $this->settings->activate($request->record_id);
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
            $this->settings->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->settings->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->settings->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->settings->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->settings->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->settings->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->settings->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->settings->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->settings->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

}