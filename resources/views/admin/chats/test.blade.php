@extends('layouts.admin.home')

<!-- title page -->
@section('title')
<title>Chats</title>
@endsection

<!-- custom css -->
@section('css')

@endsection

@section('content')

<div class="row">
    <div class="col-lg-8">
        {{-- <h1 class="page-header">Chats</h1> --}}
    </div>
    <div class="col-lg-4">
        <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/chats/index')}}">Chats</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Index</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chats Viwes
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                @include('flash::message')
                <div class="row">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6 text-right">
                        <div id="dataTables-example_filter" class="dataTables_filter">
                            <!-- <label><input placeholder="search" type="search" class="form-control input-sm data_search" aria-controls="dataTables-example"></label> -->
                        </div>
                    </div>
                </div>
                <div class="dataTable_wrapper">

                    <section class="message-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="chat-area">
                                        <div class="chatbox">
                                            <div class="modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="msg-body">
                                                            <ul id="messages-area">
                                                                @foreach(\DB::table('messages')->get() as $notifi)
                                                                    <li class="{{$notifi->senderable_type == 'App\Models\Lawyer' ? 'sender' : 'repaly'}}">
                                                                        <p>{{$notifi->body}}</p>
                                                                        <span class="time">{{$notifi->created_at}}</span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="send-box">
                                                        <form action="">
                                                            <input type="text" class="form-control" aria-label="message…" placeholder="Write message…" id="message">
                                                            <button type="button" onclick="sendMessage()"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->
</div>

@endsection

<!-- custom js -->
@section('script')
<script>
    jQuery(document).ready(function() {
        $(".chat-list a").click(function() {
            $(".chatbox").addClass('showbox');
            return false;
        });
        $(".chat-icon").click(function() {
            $(".chatbox").removeClass('showbox');
        });
    });
</script>

<script>
    $('.chatbox').scrollTop($('.chatbox')[0].scrollHeight);
    var to_token = "{{auth()->guard('admin')->user()->token2}}";
    var from_token = "{{auth()->guard('admin')->user()->token}}";
    var messagesArea = document.getElementById('messages-area');

    // var conn = new WebSocket('https://verny.clincher.evyx.xyz/comm?token=' + from_token);
    var conn = new WebSocket('ws://localhost:8080?token=' + from_token);
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    $(document).on('change', '#messages', function(){
        sendMessage();
    })

    conn.onmessage = function(event) {
        const data = JSON.parse(event.data);
        console.log(event);
        messagesArea.innerHTML += `
            <li class="repaly">
                <p>${data.content}</p>
                <span class="time">${data.time}</span>
            </li>
        `;
        $('.chatbox').scrollTop($('.chatbox')[0].scrollHeight);
    };

    function sendMessage() {
        var input = document.getElementById('message');
        if (input.value) {
            var data = {
                to_token: to_token,
                from_token: from_token,
                content: input.value,
                type: 'request_chat_history'
            };
            conn.send(JSON.stringify(data));
            messagesArea.innerHTML += `
                <li class="sender">
                    <p>${input.value}</p>
                    <span class="time">18:25:13</span>
                </li>
            `;
            input.value = '';
            $('.chatbox').scrollTop($('.chatbox')[0].scrollHeight);
        }
    }
</script>
@endsection