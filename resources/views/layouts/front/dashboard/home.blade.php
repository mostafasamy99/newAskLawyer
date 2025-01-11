<!DOCTYPE html>
<html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v5.15.4/css/all.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap">
        <link href="{{asset('generalcss/select_2.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('front/assets/css/dashboard.css')}}">
        <link rel='stylesheet' href="https://unpkg.com/css-pro-layout@1.1.0/dist/css/css-pro-layout.css">
        <title>Dashboard</title>
        @yield('css')
    </head>
    <body>
        <div class="layout has-sidebar fixed-sidebar fixed-header">
            @include('layouts.front.dashboard.header')
            
            <div class="layout">
                {{ csrf_field() }}
                <main class="content">
                    <div class="head-content">
                        
                        <div class="topbar">
                            <div class="icons">
                                <i class="far fa-sync-alt"></i>
                                <i class="far fa-filter"></i>
                                <i class="far fa-undo"></i>
                                <div class="dropdown notifications-area">
                                    <a class="notification position-relative" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="false">
                                        <i class="fas fa-bell"></i>
                                        <span class="notification-badge">
                                            {{auth()->guard('lawyer')->check() ? (auth()->guard('lawyer')->user()->notifications()->unRead()->count() ?? 0) : 0}}
                                        </span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="dropdownMenuLink" style="width: 300px;">
                                        <!-- the navigation -->
                                        <ul class="nav nav-tabs" id="notificationTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="user-tab" data-bs-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">
                                                    User
                                                </a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">
                                                    General
                                                </a>
                                            </li>
                                        </ul>
                                
                                        <div class="tab-content mt-2" id="notificationTabContent">
                                            <!-- User Notifications -->
                                            <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                                                <ul class="list-unstyled dropdown-user-notifications-area"></ul>
                                            </div>
                                            <!-- General Notifications -->
                                            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                                                <ul class="list-unstyled dropdown-general-notifications-area"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="search">
                                <i class="far fa-search"></i>
                                <input type="text" placeholder="بحث">
                            </div>
                            <div>
                                <a id="btn-toggle" href="#" class="sidebar-toggler break-point-sm">
                                    <i class="far fa-bars"></i>
                                </a>
                                <a id="btn-collapse" class="sidebar-collapser d-block d-xl-none d-lg-none d-md-block d-xs-block">
                                    <i class="far fa-bars"></i>
                                </a>
                                <span>اضافة مدونة قانونية</span>
                            </div>
                        </div>
                         @yield('content')

                    </div>
                </main>
                <div class="overlay"></div>
            </div>
            
        </div>
        @include('layouts.front.dashboard.footer')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('generaljs/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('generaljs/select_2.js')}}"></script>        
        <script src="{{asset('front/assets/js/dashboard.js')}}"></script>
        @yield('script')
        <script>
            var _token = $('input[name="_token"]').val();
            var userTypeNo = `{{auth()->guard('lawyer')->check() ? 1 : 2}}`;
            var authToken = `{{auth()->guard('lawyer')->check() ? auth()->guard('lawyer')->user()->token : auth()->guard('web')->user()->token}}`;
            var conn = new WebSocket('ws://localhost:8080?token=' + authToken + '&user_type_no=' + userTypeNo);
            conn.onopen = function(e) {
                console.log("Connection established!");
            };
            conn.onmessage = function(event) {
                const data = JSON.parse(event.data);
                
                if (data.type == 'fixed_services_request') {
                    $('.notification-badge').text(parseInt($('.notification-badge').text(), 10) + 1);

                    if ($('#dropdownMenuLink').hasClass('show')) {

                        if (data.notification_type == 1) {
                            
                            $('.dropdown-general-notifications-area').prepend(
                                `<li><a class="dropdown-item" href="${data.price_secreen_route}">${data.title}</a></li>`
                            );
                        }
                    }
                }
                @yield('webSocketScriptOnMessage')
            };
            conn.onerror = function(error) {
                console.error("WebSocket Error: ", error);
            };
            conn.onclose = function(e) {
                console.log("Connection closed: ", e);
            };
        </script>
        <script>
            $(document).on('click', function (event) {
                if ($('.dropdown-menu').hasClass('show') && !$(event.target).closest('.notifications-area, .dropdown-menu').length) {
                    if (!$(event.target).closest('.dropdown-menu').length) {
                        $('.dropdown-menu').removeClass('show');
                    }
                }
            });
            $(document).on('click', '.notifications-area', function (e) {
                var user_notifi = ``;
                var general_notifi = ``;
                if (!$('#dropdownMenuLink').hasClass('show')) {}
                $.ajax({
                    url: `{{route('dashboard/notifications')}}`,
                    method: 'GET',
                    data: { _token: _token },
                    success: function (data) {
                        $('.notification-badge').text(0);
                        if (data.user_notification && data.user_notification.length > 0) {
                            for (let index = 0; index < data.user_notification.length; index++) {
                                const element = data.user_notification[index];
                                user_notifi += `<li><a class="dropdown-item" href="${element.targetable?.price_secreen_route}">${element.content}</a></li>`;
                            }
                            $('.dropdown-user-notifications-area').empty().append(user_notifi);
                        }
                        if (data.general_notification && data.general_notification.length > 0) {
                            for (let index = 0; index < data.general_notification.length; index++) {
                                const element = data.general_notification[index];
                                general_notifi += `<li><a class="dropdown-item" href="${element.targetable?.price_secreen_route}">${element.content}</a></li>`;
                            }
                            $('.dropdown-general-notifications-area').empty().append(general_notifi);
                        }
                    }
                }) 
            });
        </script>
    </body>
</html>