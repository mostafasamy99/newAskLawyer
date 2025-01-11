<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\ServicesLayer\Front\UserServices\UserService;
use App\Models\Notification;
use App\Models\Report;
use App\Traits\Front\GeneralTrait;
use Illuminate\Http\Request;

class DashboradController extends Controller
{
    use GeneralTrait;
    public $report;
    public $userService;
    public $notification;

    public function __construct(Report $report, UserService $userService, Notification $notification)
    {
        $this->report = $report;
        $this->userService = $userService;
        $this->notification = $notification;
    }

    public function home()
    {
        $data = $this->reportPage(['services']);
        $requests = $this->userService->getRequests();
        return view('front/dashboard/home', get_defined_vars());
    }

    public function service($id)
    {
        $data = $this->reportPage(['services',
            'service' => function($query) use($id) {
                return $query->find($id);
            },
            'requests' => function($query) use($id) {
                if (auth()->guard('lawyer')->check()) {
                    // if ($id == 6 || $id == 11) {
                    if ($id == 11) {
                        return $query->whereService_id($id)->latest()->with(['lawyer', 'user', 'service', 'answer'])
                            ->whereHas('answers', function ($subQuery) {
                                $subQuery->where('lawyer_id', auth()->guard('lawyer')->user()->id);
                            }
                        );
                    } else {
                        return $query->whereService_id($id)->whereLawyer_id(auth()->guard('lawyer')->user()->id)->whereIn('status', [1, 2])->latest()->with(['lawyer', 'user', 'service', 'answer']);
                    }
                } elseif (auth()->guard('web')->check()) {
                    return $query->whereService_id($id)->whereUser_id(auth()->guard('web')->user()->id)->whereIn('status', [1, 2])->latest()->with(['lawyer', 'user', 'service']);
                }
            }
        ]);
        // dd($data);
        return view('front/dashboard/service', get_defined_vars());
        // return $query->whereService_id($id)->whereLawyer_id(auth()->guard('lawyer')->user()->id)->whereStatus(1)->with(['lawyer', 'user', 'service'])
        //     ->whereDoesntHave('answers', function ($subQuery) {
        //         $subQuery->where('lawyer_id', auth()->guard('lawyer')->user()->id);
        //     }
        // );.
    }

    public function settings()
    {
        $data = $this->reportPage(['services']);
        return view('front/dashboard/settings', get_defined_vars());
    }

    public function profile()
    {
        $data = $this->reportPage(['services']);
        return view('front/dashboard/settings', get_defined_vars());
    }

    public function blogs()
    {
        $data = $this->reportPage(['services', 'blogs' => function ($q) {
            $q->lawyerBlogs();
        }]);
        return view('front/dashboard/blogs', get_defined_vars());
    }

    public function notifications()
    {
        $notifications['general_notification'] = $this->userService->userNotification() ?? [];
        $notifications['user_notification'] = $this->userService->userAuthNotification() ?? [];
        return $notifications;
    }

}
