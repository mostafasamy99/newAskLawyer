<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Eloquent\BlogRepository;
use App\Http\Requests\BlogRequests\BlogStoreRequest;
use App\Http\Requests\BlogRequests\BlogUpdateRequest;
use App\Models\Report;
use App\Traits\Front\GeneralTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    use GeneralTrait;
    public $report;
    public $blogRepository;

    public function __construct(Report $report, BlogRepository $blogRepository)
    {
        $this->report = $report;
        $this->blogRepository = $blogRepository;
    }

    public function addBlog()
    {
        $data = $this->reportPage(['services']);
        return view('front/dashboard/add_blog', get_defined_vars());
    }

    public function store(BlogStoreRequest $request)
    {
        try{
            // $request->merge(['is_publish' => 0]);
            $this->blogRepository->storeBlog($request, auth()->guard('lawyer')->user(), 2, 0, 0);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function editBlog($id)
    {
        $data = $this->reportPageORM(['services', 'blog' => function ($q) use($id) {
            $q->lawyerBlogs()->where('id', $id);
        }]);
        return view('front/dashboard/edit_blog', get_defined_vars());
    }

    public function update(BlogUpdateRequest $request, $id)
    {
        try{
            $this->blogRepository->update($request, $id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }

    public function cost($id)
    {
        $data = $this->reportPageORM(['services', 'blog' => function ($q) use($id) {
            $q->fixedService()->where('id', decrypt($id));
        }]);
        return view('front/dashboard/lawyer_price', get_defined_vars());
    }

    public function costUpdate(Request $request, $id)
    {
        try{
            $this->blogRepository->costUpdate($request, $id);
            flash()->success('Success');
            return back();
        }catch(\Exception $e){
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
    }


}
