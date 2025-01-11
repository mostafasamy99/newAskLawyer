<?php
namespace App\Traits\Front;

use App\Models\Report;
use Illuminate\Database\Eloquent\Model;

trait GeneralTrait
{
    public $report;

    public function __construct(Model $report)
    {
        $this->report = $report;
    }
    
    public function reportPage(array $with, array $withCount = []) 
    {
        return $this->report->with($with)->withCount($withCount)->first()->toArray();
    }
    
    public function reportPageORM(array $with, array $withCount = []) 
    {
        return $this->report->with($with)->withCount($withCount)->first();
    }

    public function handle_request($request)
    {
        $request->password ? $request->merge(['password' => bcrypt($request->password)]) : "";
        if (!$request->hasFile('photo') == null) {
            $file = uploadIamge($request->file('photo'), $this->crudName()); // function on helper file to upload file
            $request->merge(['img' => $file]);
        }
        $request = array_filter(array_intersect_key($request->all(), $this->model->fildes()));
        return $request;
    }
}