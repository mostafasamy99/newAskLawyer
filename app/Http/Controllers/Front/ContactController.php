<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequests;
use App\Http\ServicesLayer\Front\ContactServices\ContactService;
use App\Models\Report;
use App\Traits\Front\GeneralTrait;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use GeneralTrait;
    public $report;
    public $contactService;

    public function __construct(Report $report, ContactService $contactService)
    {
        $this->report = $report;
        $this->contactService = $contactService;
    }

    public function store(ContactRequests $request)
    {
        if($this->contactService->store($request)){
            flash()->success('Success');
        }else{
            flash()->error('please contact technical support');
        }
        if(isset($request->page) && $request->page == 1){
            $data = $this->reportPage(['settings']);
            return view('front.contact', compact('data'));
        }
        $data = $this->reportPage(['settings', 'our_blogs', 'lawyers_blogs', 'about_company', 'ask_lawyer', 'services']);
        return redirect()->route('front/index');
    }

}
