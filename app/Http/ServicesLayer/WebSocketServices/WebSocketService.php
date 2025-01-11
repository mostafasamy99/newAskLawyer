<?php

namespace App\Http\ServicesLayer\WebSocketServices;

use WebSocket\Client;

class WebSocketService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client("ws://localhost:8080?token=admin&user_type_no=2");
    }

    public function sendNotification($data)
    {
        $this->client->send($data);
        $this->client->close();
    }

    public function clients()
    {
        return $this->client;
    }
}

