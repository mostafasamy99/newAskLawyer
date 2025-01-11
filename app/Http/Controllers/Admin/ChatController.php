<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\Admin\ChatRepository;

class ChatController extends Controller
{

    public $chats;

    public function __construct(ChatRepository $chats)
    {
        $this->chats = $chats;
    }

    public function index()
    {
        return $this->chats->index();
    }

    public function test()
    {
        return $this->chats->test();
    }

    public function search(Request $request)
    {
        return $this->chats->search($request);
    }
}