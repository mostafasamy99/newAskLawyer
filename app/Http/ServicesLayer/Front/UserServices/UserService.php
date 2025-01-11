<?php

namespace App\Http\ServicesLayer\Front\UserServices;

use App\Models\Contact;
use App\Models\Notification;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\App;

class UserService
{
    public $requests;
    public $notification;

    public function __construct(RequestModel $requests, Notification $notification)
    {
        $this->requests = $requests;
        $this->notification = $notification;
    }

    public function getRequests()
    {
        if (auth()->guard('lawyer')->check()) {
            return array_merge(
                auth()->guard('lawyer')->user()->requests()->whereStatus(0)->with(['lawyer', 'user', 'service'])->whereDoesntHave('answers', function ($subQuery) {
                    $subQuery->where('lawyer_id', auth()->guard('lawyer')->user()->id);
                })->orderBy('id', 'desc')->get()->toArray(),
                $this->requests->with(['lawyer', 'user', 'service'])->whereStatus(0)->whereNull('lawyer_id')->whereDoesntHave('answers', function ($subQuery) {
                    $subQuery->where('lawyer_id', auth()->guard('lawyer')->user()->id);
                })->orderBy('id', 'desc')->get()->toArray()
            );
        }elseif (auth()->guard('web')->check()) {
            return array_merge(
                auth()->guard('web')->user()->requests()->whereStatus(0)->whereUser_id(auth()->guard('web')->user()->id)->with(['lawyer', 'user', 'service'])->orderBy('id', 'desc')->get()->toArray()
            );
        }
        return array();
    }

    public function changeLanguage($locale)
    {
        $supportedLanguages = ['en', 'ar'];
        if (!in_array($locale, $supportedLanguages)) { abort(404); }
        App::setLocale($locale);
        $segments = explode('/', trim(parse_url(url()->previous())['path'], '/'));
        if (in_array($segments[0], ['en', 'ar'])) {
            $segments[0] = $locale;
            return redirect(url(implode('/', $segments)));
        } else { 
            return redirect()->back();
        }        
    }

    public function userNotification()
    {
        $type = 'lawyers';
        if (auth()->guard('web')->check()) {
            $type = 'users';
        }
        return $this->notification->$type()->with('targetable')->orderBy('id', 'desc')->get()->toArray();
    }

    public function userAuthNotification()
    {
        $guard = 'lawyer';
        if (auth()->guard('web')->check()) {
            $guard = 'web';
        }
        $notifications = auth()->guard($guard)->user()->notifications()->with('targetable')->orderBy('id', 'desc')->get()->toArray();
        auth()->guard($guard)->user()->notifications()->update([
            'is_read' => 1
        ]);
        return $notifications;
    }
    
}