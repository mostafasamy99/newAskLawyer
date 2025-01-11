<?php

namespace App\WebSockets;

use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Socket implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";

        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryArray);
        if (!isset($queryArray['token'])) {
            $conn->close();
            return;
        }
        $token = $queryArray['token'];
        $conn->resourceId = $token;
        // $this->clients->attach($conn, ['token' => $token]);
        // user_type == 1 => lawyer || user_type == 2 => user
        $this->clients->attach($conn, [
            'token' => $token,
            'user_type' => $queryArray['user_type_no'] ?? 2,
        ]);
        echo "New token connection: {$conn->resourceId}", PHP_EOL;
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $lawyer_id = 0;
        $data = json_decode($msg);
        try {
            if (isset($data->receiver_token) && $data->type == "chat_request") {
            
                if (isset($data->request_no) && (int)$data->request_no == 0) {
                    $lawyer_id = (int)$data->sender_id;
                    DB::table('requests')->where('id', (int)$data->request_id)->update([
                        'status' => 1,
                        'lawyer_id' => $data->sender_id,
                    ]);
                }
                // $data = Message::create([
                DB::table('messages')->insert([
                    'room_id' => 1,
                    'body' => $data->content,
                    'request_id' => (int)$data->request_id,
                    'senderable_id' => $data->sender_id,
                    'senderable_type' => str_replace('-', '\\', $data->sender_type),
                    'receiverable_id' => $data->receiver_id,
                    'receiverable_type' => str_replace('-', '\\', $data->receiver_type),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                foreach ($this->clients as $client) {

                    if ($this->clients[$client]['token'] === $data->receiver_token) {
    
                        $client->send(json_encode([
                            'type' => "chat_request",
                            'lawyer_id' => $lawyer_id,
                            'request_id' => (int)$data->request_id,
                            'content' => $data->content,
                        ]));
                    }
                }
            }else if ($data->type == "fixed_services_request") {
            
                foreach ($this->clients as $client) {
                    if ((int)$this->clients[$client]['user_type'] === 1) {
    
                        $client->send(json_encode([
                            'type' => 'fixed_services_request',
                            'title' => $data->title,
                            'notification_type' => $data->notification_type,
                            'price_secreen_route' => $data->price_secreen_route,
                        ]));
                    }
                }
            }
        } catch (\Exception $e) {}
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function onOpenTest(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";

        $queryString = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryString, $queryArray);
        if (!isset($queryArray['token'])) {
            $conn->close();
            return;
        }
        $token = $queryArray['token'];
        $user = DB::table('admins')->where('token', $token)->first();
        if (!$user) {
            $conn->close();
            return;
        }
        $conn->resourceId = $token;
        $this->clients->attach($conn, ['token' => $token, 'user' => $user]);
        echo "New connection: {$conn->resourceId}", PHP_EOL;
    }

    public function onMessageTest(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg);
        if (isset($data->to_token)) {
            $toUser = DB::table('admins')->where('token', $data->to_token)->first();
            $fromUser = DB::table('admins')->where('token', $data->from_token)->first();
            if($toUser){
                if($fromUser->id == 1){
                    $senderable_type = 'App\Models\Lawyer';
                    $senderable_id = '1';
                    $receiverable_type = 'App\Models\User';
                    $receiverable_id = '2';
                }else{
                    $senderable_type = 'App\Models\User';
                    $senderable_id = '2';
                    $receiverable_type = 'App\Models\Lawyer';
                    $receiverable_id = '1';
                }

                Message::create([
                    'body' => $data->content,
                    'room_id' => 1,
                    'senderable_type' => $senderable_type,
                    'senderable_id' => $senderable_id,
                    'receiverable_type' => $receiverable_type,
                    'receiverable_id' => $receiverable_id,
                ]);
                
                foreach ($this->clients as $client) {
                    if ($this->clients[$client]['token'] === $data->to_token) {
    
                        $client->send(json_encode([
                            'content' => $data->content,
                            'time' => '17:35:12'
                        ]));
                    }
                }
            }
        } 
        // else {
        //     foreach ($this->clients as $client) {
        //         if ($from !== $client) {
        //             $client->send($data->content);
        //         }
        //     }
        // }
    }
    
}
