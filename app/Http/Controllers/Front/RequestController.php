<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\PaidRequestStore;
use App\Http\Requests\Front\RequestStore;
use App\Http\ServicesLayer\Front\RequestServices\RequestService;
use App\Traits\Front\GeneralTrait;
use Illuminate\Http\Request;
use App\Models\Report;

class RequestController extends Controller
{
    use GeneralTrait;
    public $report;
    public $requestService;

    public function __construct(Report $report, RequestService $requestService)
    {
        $this->report = $report;
        $this->requestService = $requestService;
    }

    public function home()
    {
        return view('front/dashboard/home');
    }

    public function store(RequestStore $request)
    {
        return $this->requestService->store($request);
    }

    public function confirm(Request $request)
    {
        return $this->requestService->confirm($request);
    }

    public function room(Request $request)
    {
        return $this->requestService->getRoom($request);
    }

    public function answers($id)
    {
        return $this->requestService->getAnswers($id);
    }

    public function paidServices(PaidRequestStore $request, $service_id)
    {
        try {
            $decryptedLawyerId = $request->input('lawyer_id') ? decrypt($request->input('lawyer_id')) : null;
            $decryptedBlogId = $request->input('lawyer_id') ? decrypt($request->input('lawyer_id')) : null;    
        } catch (\Exception $e) {
            flash()->error('There is something wrong , please contact technical support');
            return back();
        }
        $validator = validator()->make(
            ['lawyer_id' => $decryptedLawyerId, 'blog_id' => $decryptedBlogId],
            ['lawyer_id' => 'nullable|exists:lawyers,id', 'blog_id' => 'nullable|exists:blogs,id']
        );
        if ($validator->fails()) {
            flash()->error($validator->errors());
            return back();
        }
        return $this->requestService->storePaidServices($request, $service_id);
    }

}
