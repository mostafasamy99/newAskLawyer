<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use App\WebSockets\Socket;


class WebSocketServer extends Command
{
    protected $signature = 'websocket:serve';
    protected $description = 'Start the WebSocket server';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting WebSocket server...');
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Socket()
                )
            ),
            8080
        );
        $server->run();
    }
}

