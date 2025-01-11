@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        #chat-requests-view, #question-view, #ask-job-view, #ask-call-view {
            display: none;
        }
        #request-info {
            cursor: pointer;
        }
        .chat-container {
            max-height: 80vh;
            overflow: hidden; 
            border: 1px solid #ccc;
        }
        .chat-container .chat-messages {
            height: calc(100% - 60px); 
            overflow-y: auto; 
            display: flex;
            flex-direction: column;
        }
        .line {
            background-color:  #e2ac6c;
            width: 50%;
            height: 1px;
            margin: auto;
            margin-bottom: 8px;
            margin-top: 10px;
        }
        .parent-answers {
            text-align: center;
            position: relative;
            background-color: #F9F9F9;
            border-radius: 15px;
            padding: 15px;
            margin-bottom: 10px;
        }
        .icon-rate-box {
            position: absolute;
            left: 5px;
            top: 5px;
            background-color: #e2ac6c;
            border-radius: 5px;
            width: 25px;
            height: 25px;
            color: #fff;
            font-size: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endsection

@section('content')

    <div class="row position-relative">
        <div class="col-lg-4">
            <div class="messages">

                @isset($data['requests'])
                    @foreach ($data['requests'] as $record)
                        <div id="area-{{$record['id']}}" class="message">
                            <div class="header">
                                <span 
                                    id="request-info" class="type" request-id="{{base64_encode($record['id'])}}" sevice-id="{{base64_encode($record['service_id'])}}" 
                                    user-id="{{base64_encode($record['user_id'] ?? 0)}}" lawyer-id="{{base64_encode($record['lawyer_id'] ?? 0)}}" 
                                    user-token="{{base64_encode($record['user']['token'] ?? '')}}" lawyer-token="{{base64_encode($record['lawyer']['token'] ?? '')}}"
                                    user-name="{{base64_encode($record['user']['name'] ?? 'زائر')}}" lawyer-name="{{base64_encode($record['lawyer']['name'])}}"
                                    request-message="{{base64_encode($record['message'])}}" request-type="{{base64_encode($record['service']['name'])}}" 
                                    request-date="{{base64_encode( \Carbon\Carbon::parse($record['created_at'])->format('Y-m-d') )}}" 
                                    request-status="{{base64_encode((int)$record['status'] == 1 ? 'تم القبول' : 'تم الرفض')}}" 
                                    question-answer="{{base64_encode($record['answer']['content'] ?? '')}}"
                                >عرض</span>
                                <span class="time">{{ \Carbon\Carbon::parse($record['created_at'])->format('H:i - Y:m:d') }}</span>
                                <span class="id">#{{$record['id']}}</span>
                            </div>
                            <div class="content">
                                <div class="avatar">
                                    <img src="{{asset('front/assets/img/person.png')}}" alt="Avatar">
                                    <span class="status"></span>
                                </div>
                                <div class="text">{{ str($record['message'])->limit(50) }}</div>
                                {{-- <div class="unread"><span></span></div> --}}
                            </div>
                        </div>
                    @endforeach
                @endisset

            </div>
        </div>
        <div class="col-lg-8">
            <div id="chat-requests-view" class="chat-requests-view">
                <div class="chat-container">
                    <div class="chat-header"></div>
                    <div id="chat-messages" class="chat-messages"></div>
                    <div class="chat-input">
                        <button>
                            <i class="far fa-tags"></i>
                        </button>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="اكتب رسالة..." id="message">
                            <button>
                                <i class="far fa-paperclip"></i>
                            </button>
                        </div>
                        <button id="send-messages">
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="question-view" class="container section-content">
                <div class="container">
                    <img src="{{asset('front/assets/icons/big.jpg')}}" class="img" alt="Big Image" />
                    <div class="text-center">
                        <h1>طلبات الأسئلة</h1>
                    </div>
                    <div class="info-box">
                        <h1>
                            <img src="{{asset("front/assets/icons/question.svg")}}" alt="bag icon"> سؤال الى محام 
                        </h1>
                        <p class="show-request-message"></p>
                        <h1>
                            <img src="{{asset("front/assets/icons/clock.svg")}}" alt="clock"> تاريخ الطلب : <span class="request-at"></span>
                        </h1>
                        <h1>
                            <img src="{{asset("front/assets/icons/Econo.svg")}}" alt="Economic indicator"> مقدم الطلب : <span class="request-by"></span>
                        </h1>
                        <div>
                            <h1 class="input-label">
                                <img src="{{asset('front/assets/icons/gavel.svg')}}" alt="Economic indicator"> الاجابات على السؤال :
                            </h1>
                            <span class="input-container">
                                {{-- <textarea id="question-answer" disabled></textarea> --}}
                                <div id="question-answer"></div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ask-call-view" class="container section-content">
                <div class="container">

                    <img src="{{asset('front/assets/icons/big.jpg')}}" class="img" alt="Big Image" />
                    <div class="text-center">
                        <p class="subtext"><span class="id show-request-id"></span></p>
                    </div>
                    <div class="info-box">
                        <h1>
                            <img src="{{asset('front/assets/icons/call.svg')}}" alt="bag icon"> <span class="show-request-type"></span>
                        </h1>
                        <p class="show-request-message"></p>
                        <h1>
                            <img src="{{asset('front/assets/icons/clock.svg')}}" alt="clock"> تاريخ الطلب : <span class="request-at"></span>
                        </h1>
                        <h1>
                            <img src="{{asset('front/assets/icons/Econo.svg')}}" alt="Economic indecator"> مقدم الطلب : <span class="request-by"></span>
                        </h1>
                        <h1>
                            <img src="{{asset('front/assets/icons/Econo.svg')}}" alt="Economic indecator"> الحاله : <span class="request-status"></span>
                        </h1>
                    </div>

                </div>
            </div>
            <div id="ask-job-view" class="container section-content ask-job-view">
                <div class="container">
                    <img src="{{asset('front/assets/icons/big.jpg')}}" class="img" alt="Big Image"/>
                    <div class="text-center">
                        <p id="show-request-id" class="subtext show-request-id"></p>
                    </div>
                    <div class="info-box">
                        <h1 style="padding: 0px;">
                            <img src="{{asset('front/assets/icons/Econo.svg')}}" alt="Economic indecator"> مقدم الطلب : <span class="request-by"></span>
                        </h1>
                        <h1 style="padding: 0px;">
                            <img src="{{asset('front/assets/icons/clock.svg')}}" alt="clock"> تاريخ الطلب : <span class="request-at"></span>
                        </h1>
                        <h1>
                            <img src="{{asset('front/assets/icons/Econo.svg')}}" alt="Economic indecator"> الحاله : <span class="request-status"></span>
                        </h1>
                        <h1 style="padding: 0px;">
                            <img src="{{asset('front/assets/icons/bag2.svg')}}" alt="bag icon"> طلب توظيف محام : 
                        </h1>
                        <p class="show-request-message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- custom js -->
@section('script')
    <script>

        var id = userId = userName = headerName = userType = records =
            senderToken = receiverToken = lawyerToken = userToken =
            senderId = receiverId = senderType = receiverType = 
            requestMessage = questionAnswer = requestDate = ``;

        var _token = $('input[name="_token"]').val();
        var service = `{{$data['service']['id'] ?? 0}}`;
        var authToken = `{{auth()->guard('lawyer')->check() ? auth()->guard('lawyer')->user()->token : auth()->guard('web')->user()->token}}`;
        var input = document.getElementById('message');

        $(document).on('click', '#request-info', function (query) {
            
            lawyerId = atob($(this).attr('lawyer-id'));
            lawyerToken = atob($(this).attr('lawyer-token'));
            userToken = atob($(this).attr('user-token'));

            id = atob($(this).attr('request-id'));
            userId = atob($(this).attr('user-id'));
            $('.request-by').empty().append(decodeURIComponent(escape(atob($(this).attr('user-name')))));
            $('.request-at').empty().append(atob($(this).attr('request-date')));

            $('.show-request-type').empty().append(decodeURIComponent(escape(atob($(this).attr('request-type')))));
            $('.show-request-message').empty().append(atob($(this).attr('request-message')));
            $('.chat-messages').removeClass().addClass(`chat-messages messages-area-${id}`);

            @if (auth()->guard('lawyer')->check())
                headerName = decodeURIComponent(escape(window.atob($(this).attr('user-name'))));
                userType = 'App\\Models\\Lawyer';
            @elseif (auth()->guard('web')->check())
                headerName = decodeURIComponent(escape(window.atob($(this).attr('lawyer-name'))));
                userType = 'App\\Models\\User';
            @endif

            if (service == '11') {
                $.ajax({
                    url: `{{ route('request/answers') }}/${id}`,
                    method: 'GET',
                    data: {
                        _token: _token,
                    },
                    success: function (response) {
                        records = '';
                        // <div class="icon-rate-box"><i class="fas fa-star"></i></div>
                        for (let i = 0; i < response.data.length; i++) {
                            records += `<div class="parent-answers">
                                ${response.data[i].content} 
                                <div class="line"></div>
                            </div>`;
                        }
                        $('#question-answer').empty().append(records);
                    }
                });
                $('#question-view').css({'display': 'block'}).siblings().css('display', 'none');
            } else if (service == '10') {
                $('#ask-call-view').css({'display': 'block'}).siblings().css('display', 'none');
                $('.request-status').empty().append(decodeURIComponent(escape(atob($(this).attr('request-status')))));
            } else if (service == '8') {
                $('#ask-job-view').css({'display': 'block'}).siblings().css('display', 'none');
                $('.request-status').empty().append(decodeURIComponent(escape(atob($(this).attr('request-status')))));
            } else {

                getRoom();
            }
        });

        function getRoom()
        {
            $('#chat-requests-view').css({'display': 'block'}).siblings().css('display', 'none');
            $('.chat-header').empty().append(headerName);

            $.ajax({
                url: `{{route('dashboard/room/get')}}`,
                method: 'POST',
                data: {
                    _token: _token,
                    request_id: id,
                    user_id: userId,
                },
                success: function (response) {
                    if (response.data.length > 0) {

                        records = '';
                        for (let i = 0; i < response.data.length; i++) {
                            element = response.data[i];
                            records += `<div class="message ${element.senderable_type == userType ? 'user' : ''}">
                                <div class="text">${element.body}</div>
                                <span class="message-date">${formatDate(element.created_at)}</span>
                            </div>`;
                        }
                        $('.chat-messages').empty().append(records);
                        $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
                    } else {
                        $('.chat-messages').empty();
                    }
                }
            });
            $('#chat-requests-view').css({'display': 'block'});
        }
    
        // var conn = new WebSocket('ws://localhost:8080?token=' + authToken + '&user_type_no=' + userTypeNo);
        // conn.onopen = function(e) {
        //     console.log("Connection established!");
        // };

        // conn.onmessage = function(event) {
        //     const data = JSON.parse(event.data);
        //     $(`.messages-area-${data.request_id}`).append(`<div class="message">
        //         <div class="text">${data.content}</div>
        //         <span class="message-date">{{now()->format('h:m y-m-d')}}</span>
        //     </div>`);
        //     $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
        // };
    
        $(document).on('click', '#send-messages', function() {
            sendMessage();
        });
        $(document).on('keyup', '#message', function(e) {
            if(e.which == 13) {
                sendMessage();
            }
        });

        function sendMessage() {

            if (input.value) {

                @if (auth()->guard('lawyer')->check())
                    senderId = `{{auth()->guard('lawyer')->user()->id}}`;
                    receiverId = userId;
                    senderType = 'App-Models-Lawyer';
                    receiverType = 'App-Models-User';
                    senderToken = lawyerToken;
                    receiverToken = userToken;
                @elseif (auth()->guard('web')->check())
                    senderId = `{{auth()->guard('web')->user()->id}}`;
                    receiverId = lawyerId;
                    senderType = 'App-Models-User';
                    receiverType = 'App-Models-Lawyer';
                    senderToken = userToken;
                    receiverToken = lawyerToken;
                @endif

                var data = {
                    sender_id: senderId,
                    receiver_id: receiverId,
                    sender_type: senderType,
                    receiver_type: receiverType,
                    sender_token: senderToken,
                    receiver_token: receiverToken,
                    
                    request_no: 1,
                    request_id: id,
                    content: input.value,
                    type: 'chat_request'
                };
                conn.send(JSON.stringify(data));
                $('.chat-messages').append(`<div class="message user">
                    <div class="text">${input.value}</div>
                    <span class="message-date">{{now()->format('h:m y-m-d')}}</span>
                </div>`);
                input.value = '';
                $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
            }
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const hours = String(date.getUTCHours()).padStart(2, '0');
            const minutes = String(date.getUTCMinutes()).padStart(2, '0');
            const day = String(date.getUTCDate()).padStart(2, '0');
            const month = String(date.getUTCMonth() + 1).padStart(2, '0');
            const year = String(date.getUTCFullYear()).slice(0);
            return `${hours}:${minutes} ${year}-${month}-${day}`;
        }
    </script>
@endsection
<script>
    @section('webSocketScriptOnMessage')

        if (data.type == 'chat_request') {
            $(`.messages-area-${data.request_id}`).append(`<div class="message">
                <div class="text">${data.content}</div>
                <span class="message-date">{{now()->format('h:m y-m-d')}}</span>
            </div>`);
            $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
        }
    @endsection
</script>
