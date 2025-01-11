<?php

namespace App\Http\ServicesLayer\Admin\ChatServices;

use App\Models\Room;

class ChatService
{
    protected $model;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function search($request)
    {
        // $room = $this->model->with([
        //         'messages' => function($query){
        //             $query->with(['senderable', 'receiverable']);
        //         },
        //         'members' => function($query){
        //             $query->with(['userable']);
        //         }
        //     ])
        //     ->whereHas('members', function($query) use($request) { 
        //         $query->where('userable_type', 'App\Models\User')->where('userable_id', (int)$request->user);
        //     })
        //     ->whereHas('members', function($query) use($request) { 
        //         $query->where('userable_type', 'App\Models\Lawyer')->where('userable_id', (int)$request->lawyer);
        //     })
        // ->first();
        $room = $this->model->with(['messages'])
            ->whereHas('members', function($query) use($request) { 
                $query->where('userable_type', 'App\Models\User')->where('userable_id', (int)$request->user);
            })
            ->whereHas('members', function($query) use($request) { 
                $query->where('userable_type', 'App\Models\Lawyer')->where('userable_id', (int)$request->lawyer);
            })
        ->first();
        return $room;
    }
}