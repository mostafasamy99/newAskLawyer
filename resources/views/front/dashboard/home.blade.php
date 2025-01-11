@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        #chat-requests-view, #ask-job-view, #offer-price-view, #question-view, #ask-call-view {
            display: none;
        }
        #request-info {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    {{ csrf_field() }}
    <div class="row position-relative">
        <div class="col-lg-4">
            <div class="messages" style="max-height: 600px;">
                
                @isset($requests)
                    @foreach ($requests as $record)
                        <div id="area-{{$record['id']}}" class="message">
                            <div class="header" style="font-size: 11px;">
                                <span 
                                    class="type span-area-{{$record['id']}}" id="request-info" request-id="{{base64_encode($record['id'])}}"
                                    request-message="{{base64_encode($record['message'])}}" request-type="{{base64_encode($record['service']['name'])}}" 
                                    request-date="{{base64_encode( \Carbon\Carbon::parse($record['created_at'])->format('Y-m-d') )}}" 
                                    user-name="{{base64_encode($record['user']['name'] ?? 'زائر')}}" service-id="{{base64_encode($record['service_id'])}}" 
                                    user-id="{{base64_encode($record['user_id'] ?? 0)}}" lawyer-id="{{base64_encode($record['lawyer_id'] ?? 0)}}"
                                    user-token="{{base64_encode($record['user']['token'] ?? '')}}" lawyer-token="{{base64_encode($record['lawyer']['token'] ?? '')}}"
                                    user-name="{{base64_encode($record['user']['name'] ?? 'زائر')}}" lawyer-name="{{base64_encode($record['lawyer']['name'] ?? '')}}"
                                >{{$record['service']['name']}}</span>
                                <span class="time">{{ \Carbon\Carbon::parse($record['created_at'])->format('H:i / Y-m-d') }}</span>
                                <span class="id">#{{$record['id']}}</span>
                            </div>
                            <div class="content">
                                <div class="text">{{ str($record['message'])->limit(50) }}</div>
                            </div>
                        </div>
                    @endforeach
                @endisset
                
            </div>
        </div>
        <div class="col-lg-8">
            <div id="requests-area">
                <div id="chat-requests-view" class="chat-requests-view">
                    {{-- <div class="container">
                        <div class="head">
                            <div class="show-request-type" class="btn"></div>
                        </div>
                        <div id="show-request-id" class="id show-request-id"></div>
                        <div id="show-request-separator" class="separator"></div>
                        <div class="description show-request-message"></div>
                        <button class="accept-button acceptBtn" id="acceptBtn">قبول</button>
                    </div> --}}
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
                            <h1><span class="show-request-type"></span></h1>
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
                            @if (auth()->guard('lawyer')->check())
                                <div>
                                    <h1 class="input-label">
                                        <img src="{{asset('front/assets/icons/gavel.svg')}}" alt="Economic indicator"> الاجابة على السؤال :
                                    </h1>
                                    <span class="input-container">
                                        <textarea id="question-answer"></textarea>
                                    </span>
                                </div>
                                <button class="accept-button acceptBtn">ارسال</button>
                            @endif
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
                            @if (auth()->guard('lawyer')->check())
                                <div class="text-center buttons">
                                    <button type="button" action-type="1" class="acceptBtn btn first-button btn-lg">قبول</button>
                                    <button type="button" action-type="2" class="acceptBtn btn btn-lg second-button">رفض</button>
                                </div>
                            @endif
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
                            <h1 style="padding: 0px;">
                                <img src="{{asset('front/assets/icons/bag2.svg')}}" alt="bag icon"> طلب توظيف محام : 
                            </h1>
                            <p class="show-request-message"></p>
                            
                            @if (auth()->guard('lawyer')->check())
                                <div class="text-center buttons">
                                    <button type="button" action-type="1" class="btn first-button btn-lg acceptBtn">قبول</button>
                                    <button type="button" action-type="2" class="btn btn-lg second-button acceptBtn">رفض</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="offer-price-view" class="container section-content offer-price-view">
                    <div class="container">
                        {{-- <img src="{{asset('front/assets/icons/big.jpg')}}" class="img" alt="Big Image"/> --}}
                        <div class="text-center">
                            <h1><span class="show-request-type"></span></h1>
                        </div>
                        <div class="info-box">
                            <h1>
                                <img src="{{asset('front/assets/icons/Econo.svg')}}" alt="Economic indecator"> مقدم الطلب : <span class="request-by"></span>
                            </h1>
                            <h1>
                                <img src="{{asset('front/assets/icons/clock.svg')}}" alt="clock"> تاريخ الطلب : <span class="request-at"></span>
                            </h1>
                            <h1>
                                <img src="{{asset('front/assets/icons/orderList.svg')}}" alt="bag icon"> <span class="show-request-type"></span>
                            </h1>
                            <p class="show-request-message"></p>
                            <div>
                                <h1 class="input-label">
                                    <img src="{{asset('front/assets/icons/money.svg')}}" alt="Economic indicator">
                                    المبلغ المطلوب :
                                </h1>
                                <span class="input-container">
                                    <input id="offer-price-cost" type="number"/>
                                </span>
                            </div>
                            <div>
                                <h1 class="input-label">
                                    <img src="{{asset('front/assets/icons/details.svg')}}" alt="Economic indicator">
                                    التفاصيل :
                                </h1>
                                <span class="input-container">
                                    <textarea id="offer-price-desc"></textarea>
                                </span>
                            </div>
                            
                            @if (auth()->guard('lawyer')->check())
                                <button class="accept-button acceptBtn">ارسال</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
                </div>             
                </div>             
            </div>
        </main>
        <div class="overlay"></div>   
    </div>

    </div>
            </div>
        </main>
        <div class="overlay"></div>   
    </div>

@endsection

<!-- custom js -->
@section('script')
    <script>
        var id = serviceId = offerPriceCost = offerPriceDesc = questionAnswer = 
            requestDate = actionType = userId = userName = headerName = lawyerId =
            userType = records = senderToken = receiverToken = lawyerToken = 
            userToken = senderId = receiverId = senderType = receiverType = 
            requestMessage = ``;

        var requestNo = 0;
        var _token = $('input[name="_token"]').val();
        var input = document.getElementById('message');
        
        $(document).on('click', '#request-info', function () {
            requestNo = 0;
            lawyerId = atob($(this).attr('lawyer-id'));
            lawyerToken = atob($(this).attr('lawyer-token'));
            userToken = atob($(this).attr('user-token'));

            id = atob($(this).attr('request-id'));
            userId = atob($(this).attr('user-id'));
            serviceId = atob($(this).attr('service-id'));
            $('.show-request-id').empty().append('#' + id);
            
            $('.request-by').empty().append(decodeURIComponent(escape(atob($(this).attr('user-name')))));
            $('.request-at').empty().append(atob($(this).attr('request-date')));
            
            $('.show-request-type').empty().append(decodeURIComponent(escape(atob($(this).attr('request-type')))));
            $('.show-request-message').empty().append(atob($(this).attr('request-message')));
            $('.acceptBtn').attr('request-id', id);
            $('.chat-messages').removeClass().addClass(`chat-messages messages-area-${id}`);

            @if (auth()->guard('lawyer')->check())
                headerName = decodeURIComponent(escape(window.atob($(this).attr('user-name'))));
                userType = 'App\\Models\\Lawyer';
            @elseif (auth()->guard('web')->check())
                headerName = decodeURIComponent(escape(window.atob($(this).attr('lawyer-name'))));
                userType = 'App\\Models\\User';
            @endif
            
            if (serviceId == '9') {
                if (lawyerId > 0 || userType == 'App\\Models\\Lawyer') {
                    $('#chat-requests-view').css({'display': 'block'}).siblings().css('display', 'none');
                    getRoom();
                } else {
                    $('#errorModalPending').modal('show');
                }
                // $('#chat-requests-view').find('.acceptBtn').attr({'request-id': id, 'service-id': serviceId});
            } else if (serviceId == '6') {
                $('#offer-price-view').css({'display': 'block'}).siblings().css('display', 'none');
                getRoom();
            } else if (serviceId == '8') {
                $('#ask-job-view').css({'display': 'block'}).siblings().css('display', 'none');
            } else if (serviceId == '10') {
                $('#ask-call-view').css({'display': 'block'}).siblings().css('display', 'none');
            } else if (serviceId == '11') {
                $('#question-view').css({'display': 'block'}).siblings().css('display', 'none');
            } else {
                $('#requests-area').children().css('display', 'none');
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

        $(document).on('click', '.acceptBtn', function () {
            
            if (serviceId == '6') {
                offerPriceCost = $('#offer-price-cost').val();
                offerPriceDesc = $('#offer-price-desc').val();
            } else if (serviceId == '8' || serviceId == '10') {
                actionType = $(this).attr('action-type');
            } else if (serviceId == '11') {
                questionAnswer = $('#question-answer').val();
            }
            var obj = {
                _token: _token,
                request_id: id,
                service_id: serviceId,
                offer_price_cost: offerPriceCost,
                offer_price_desc: offerPriceDesc,
                question_answer: questionAnswer,
                action_type: actionType,
            };
            sendAjaxRequest(obj);
            $('#requests-area').children().css('display', 'none');
        })

        function sendAjaxRequest(obj) 
        {
            $.ajax({
                url: `{{ route('request/confirm') }}`,
                method: 'POST',
                data: obj,
                success: function (data) {
                    if (data.status == 200) {
                        $(`#area-${id}`).remove();
                        $('#myModal').modal('show');
                    }else{
                        $('#errorModal').modal('show');
                    }
                }
            })
        }

        // var conn = new WebSocket('ws://localhost:8080?token=' + authToken + '&user_type_no=' + userTypeNo);
        // conn.onopen = function(e) {
        //     console.log("Connection established!");
        // };

        // conn.onmessage = function(event) {

        //     const data = JSON.parse(event.data);
        //     if (data.type == "chat_request") {
        //         if (data.lawyer_id > 0) {
        //             $.ajax({
        //                 url: `{{ route('front/api/lawyer') }}/${data.lawyer_id}`,
        //                 method: 'get',
        //                 data: {
        //                     _token: _token,
        //                 },
        //                 success: function (responseData) {
        //                     if (responseData.status == 200) {
        //                         lawyerId = responseData.data.id;
        //                         userType = responseData.data.name;
        //                         lawyerToken = responseData.data.token;
        //                         $(`.span-area-${data.request_id}`).removeAttr('lawyer-id').removeAttr('lawyer-name').removeAttr('lawyer-token')
        //                         .attr('lawyer-id', btoa(responseData.data.id))
        //                         .attr('lawyer-name', btoa(responseData.data.name))
        //                         .attr('lawyer-token', btoa(responseData.data.token));
        //                     }
        //                 }
        //             })
        //         }
        //         $(`.messages-area-${data.request_id}`).append(`<div class="message">
        //             <div class="text">${data.content}</div>
        //             <span class="message-date">{{now()->format('h:m y-m-d')}}</span>
        //         </div>`);
        //         $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
        //     }
        // };
    
        $(document).on('click', '#send-messages', function() {
            if (lawyerId > 0 || userType == 'App\\Models\\Lawyer') {
                sendMessage();
            } else {
                $('#errorModalPending').modal('show');
            }
        });
        $(document).on('keyup', '#message', function(e) {
            if(e.which == 13) {
                if (lawyerId > 0 || userType == 'App\\Models\\Lawyer') {
                    sendMessage();
                } else {
                    $('#errorModalPending').modal('show');
                }
            }
        });

        function sendMessage() {

            if (input.value) {

                @if (auth()->guard('lawyer')->check())
                    senderId = `{{auth()->guard('lawyer')->user()->id}}`;
                    receiverId = userId;
                    senderType = 'App-Models-Lawyer';
                    receiverType = 'App-Models-User';
                    senderToken = `{{auth()->guard('lawyer')->user()->token}}`;
                    receiverToken = userToken;
                @elseif (auth()->guard('web')->check())
                    senderId = `{{auth()->guard('web')->user()->id}}`;
                    receiverId = lawyerId;
                    senderType = 'App-Models-User';
                    receiverType = 'App-Models-Lawyer';
                    senderToken = `{{auth()->guard('web')->user()->token}}`;
                    receiverToken = lawyerToken;
                    requestNo++;
                @endif

                var data = {
                    sender_id: senderId,
                    receiver_id: receiverId,
                    sender_type: senderType,
                    receiver_type: receiverType,
                    sender_token: senderToken,
                    receiver_token: receiverToken,
                    
                    request_no : requestNo,
                    request_id: id,
                    content: input.value,
                    type: 'chat_request'
                };
                requestNo++;
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
        if (data.type == "chat_request") {
            if (data.lawyer_id > 0) {
                $.ajax({
                    url: `{{ route('front/api/lawyer') }}/${data.lawyer_id}`,
                    method: 'get',
                    data: {
                        _token: _token,
                    },
                    success: function (responseData) {
                        if (responseData.status == 200) {
                            lawyerId = responseData.data.id;
                            userType = responseData.data.name;
                            lawyerToken = responseData.data.token;
                            $(`.span-area-${data.request_id}`).removeAttr('lawyer-id').removeAttr('lawyer-name').removeAttr('lawyer-token')
                            .attr('lawyer-id', btoa(responseData.data.id))
                            .attr('lawyer-name', btoa(responseData.data.name))
                            .attr('lawyer-token', btoa(responseData.data.token));
                        }
                    }
                })
            }
            $(`.messages-area-${data.request_id}`).append(`<div class="message">
                <div class="text">${data.content}</div>
                <span class="message-date">{{now()->format('h:m y-m-d')}}</span>
            </div>`);
            $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
        }
    @endsection
</script>