<?php

namespace App\Http\Repositories\Eloquent\Admin;

use App\Http\ServicesLayer\Admin\ChatServices\ChatService;
use DevxPackage\AbstractRepository;

class ChatRepository extends AbstractRepository
{

    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function crudName(): string
    {
        return 'chats';
    }

    public function index()
    {
        return view('admin.chats.index');
    }

    public function test()
    {
        return view('admin.chats.test');
    }

    public function search($request)
    {
        return $this->chatService->search($request);
    }

}