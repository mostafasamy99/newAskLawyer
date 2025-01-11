<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\BlogRepository;
use App\Http\Requests\BlogRequests\BlogStoreRequest;
use App\Http\Requests\BlogRequests\BlogUpdateRequest;

class BlogController extends Controller
{

    public $blogs;

    public function __construct(BlogRepository $blogs)
    {
        $this->blogs = $blogs;
    }

    public function index($offset, $limit)
    {
        try{
            return $this->blogs->index($offset, $limit);
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function create()
    {
        return $this->blogs->create();
    }

    public function store(BlogStoreRequest $request)
    {
        try{
            $this->blogs->storeBlog($request, auth()->guard('admin')->user(), 1, 1, $request->is_fixed_service ?? 0);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function edit($id)
    {
        return $this->blogs->edit($id);
    }

    public function update(BlogUpdateRequest $request, $id)
    {
        try{
            $this->blogs->updateBlog($request, $id, $request->is_fixed_service ?? 0);
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
            $this->blogs->activate($request->record_id);
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
            $this->blogs->delete($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function search(Request $request)
    {
        return $this->blogs->search($request);
    }

    public function searchByColumn(Request $request)
    {
        return $this->blogs->searchByColumn($request);
    }

    public function pagination($offset, $limit)
    {
        return $this->blogs->pagination($offset, $limit);
    }

    public function archives($offset, $limit)
    {
        return $this->blogs->archivesPage($offset, $limit);
    }

    public function archivesPagination($offset, $limit)
    {
        return $this->blogs->archives($offset, $limit);
    }

    public function archivesSearch(Request $request)
    {
        return $this->blogs->archivesSearch($request);
    }

    public function archivesSearchByColumn(Request $request)
    {
        return $this->blogs->archivesSearchByColumn($request);
    }


    public function back(Request $request)
    {
        try{
            $this->blogs->back($request->record_id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function sort (Request $request){
        $this->blogs->update($request, $request->record_id);
        // $this->blogs->sort($request);
        flash()->success('Success');
        return back();
    }
}
