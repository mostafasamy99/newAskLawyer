<header class=" page-header light-header menu-on-end  header-basic" id="page-header">
    <div class="bar-bottom">
        <div class="container">
            <nav class="menu-navbar">
                <div class="header-logo"><a class="logo-link" href="{{route('front/index')}}"><img class="logo-img light-logo" src="{{$data['settings'] ? asset($data['settings']['logo']) : ''}}" alt="logo" /><img class="logo-img  dark-logo" src="{{$data['settings'] ? asset($data['settings']['logo']) : ''}}" alt="logo" /></a></div>
                <div class="links menu-wrapper">
                    <ul class="list-js links-list">
                        <li class="menu-item"><a id="home" class="menu-link" href="{{route('front/index')}}">الرئيسيه </a></li>
                        <li class="menu-item"><a id="about-us" class="menu-link" href="{{route('front/about')}}">عن الشركة</a></li>
                        <li class="menu-item"><a id="process" class="menu-link" href="{{route('front/how-it-works')}}">كيفية سير العملية</a></li>
                        <div class="dropdown menu-item">
                            <div class="menu-link sub-menu-item dropdown-toggle" id="sub-menu-item" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                ابحث عن
                            </div>
                            <ul class="dropdown-menu dropdown-menu-lg-end text-end">
                                <li><a class="dropdown-item" href="{{route('front/lawyers')}}">محام</a></li>
                                <li><a class="dropdown-item" href="{{route('front/companies')}}">شركه محاماه</a></li>
                            </ul>
                            {{-- <div class="dropdown menu-item">
                                <div class="menu-link sub-menu-item  active dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    ابحث عن
                                </div>
                                <ul class="dropdown-menu dropdown-menu-lg-start dropdown-menu-right">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        {{-- <li class="menu-item  sub-menu-item"><a id="get-lawyer" class="menu-link" href="{{route('front/lawyers')}}">ابحث عن</a></li> --}}
                        {{-- <li class="menu-item sub-menu-item"><a id="" class="menu-link sub-menu-link" href="{{route('front/hire-a-lawyer')}}">وظف محام</a></li> --}}
                        <li class="menu-item sub-menu-item"><a id="privacy" class="menu-link sub-menu-link" href="{{route('front/privacy-policy')}}">سياسة الخصوصية</a></li>
                        <li class="menu-item sub-menu-item"><a id="legal-info" class="menu-link sub-menu-link" href="{{route('front/legal-info')}}">معلومات قانونية</a></li>
                        <li class="menu-item sub-menu-item"><a id="contacts" class="menu-link sub-menu-link" href="{{route('front/contact')}}">اتصل بنا</a></li>
                    </ul>
                </div>
                <div class="controls-box">
                    <div class="profile">
                        <div class="user"></div>
                        <div id="auth" class="img-box menu-link">
                            <i class="fa-regular fa-circle-user"></i>
                        </div>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="{{route('dashboard/home')}}"><i class="ph-bold ph-user"></i>&nbsp;Profile</a></li>
                            @if (auth()->guard('lawyer')->check() || auth()->guard('web')->check())
                                {{-- <li><a href="#"><i class="ph-bold ph-envelope-simple"></i>&nbsp;Inbox</a></li> --}}
                                <li><a href="{{route('dashboard/settings/get')}}"><i class="ph-bold ph-gear-six"></i>&nbsp;Settings</a></li>
                                {{-- <li><a href="#"><i class="ph-bold ph-question"></i>&nbsp;Help</a></li> --}}
                                <li><a href="{{route('dashboard/logout')}}"><i class="ph-bold ph-sign-out"></i>&nbsp;Sign Out</a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="flag">
                        <div class="controls-box">
                            @if(app()->getLocale() == "ar")
                                <a href="{{route('change-language', 'en')}}">
                                    <img src="{{asset('front/assets/img/us-flag.gif')}}" alt="">
                                </a>
                            @else
                                <a href="{{route('change-language', 'ar')}}">
                                    <img src="{{asset('front/assets/img/sa-flag.gif')}}" alt="">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="control info-toggler"><span> </span><span> </span><span></span></div>
                    <div class="control menu-toggler"><span></span><span></span><span></span></div>
                </div>
                <!-- <div class="controls-box">
                    @if(app()->getLocale() == "ar")
                        <a href="{{route('change-language', 'en')}}">en</a>
                    @else
                        <a href="{{route('change-language', 'ar')}}">ar</a>
                    @endif
                </div> -->
            </nav>
        </div>
    </div>
</header>

<script>
    var chartData = {
        labels: ["January", "February", "March", "April", "May", "June"],
        datasets: [{
            fillColor: "#79D1CF",
            strokeColor: "#79D1CF",
            data: [60, 80, 81, 56, 55, 40]
        }]
    };
    var data = {
        labels: [
            "الاسئلة الغير مجاب عليها",
            "الاسئلة المجاب عليها   "
        ],
        datasets: [{
            data: [40, 60],
            backgroundColor: [
                "#052440",
                "#E2AC6C"
            ],
            hoverBorderColor: [
                "#052440", "#E2AC6C"
            ]
        }]
    };
    var piectx = document.getElementById("chart1").getContext("2d");
    var pieChart = new Chart(piectx, {
        type: 'pie',
        data: data,
        options: {
            showAllTooltips: true,
            animation: {
                animateRotate: true,
                animateScale: true
            },
            elements: {
                arc: {
                    borderColor: "#fff"
                }
            },
            title: {
                display: true,
                text: 'Custom Chart Title',
                fontSize: 18,
                padding: 20,
                fontColor: "#999",
                fontStyle: 'Normal',
                fontFamily: "Montserrat",
                fullWidth: true
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    boxWidth: 30,
                    fontColor: "#999",
                    fontFamily: "Montserrat",
                    fullWidth: true
                }
            },
            tooltips: {
                enabled: false,
                bodyFontColor: "#052440",
                fontStyle: 'Normal',
                bodyFontFamily: "Montserrat",
                cornerRadius: 2,
                backgroundColor: "#052440",
                xPadding: 7,
                yPadding: 7,
                caretSize: 5,
                bodySpacing: 10
            }

        }
    });
    var columnctx = document.getElementById("chart2").getContext('2d');
    var col2 = new Chart(columnctx, {
        type: 'pie',
        data: data,
        options: {
            showAllTooltips: true,
            animation: {
                animateRotate: true,
                animateScale: true
            },
            elements: {
                arc: {
                    borderColor: "#fff"
                }
            },
            title: {
                display: true,
                text: 'Custom Chart Title',
                fontSize: 18,
                padding: 20,
                fontColor: "#999",
                fontStyle: 'Normal',
                fontFamily: "Montserrat",
                fullWidth: true
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    boxWidth: 30,
                    fontColor: "#999",
                    fontFamily: "Montserrat",
                    fullWidth: true
                }
            },
            tooltips: {
                enabled: false,
                bodyFontColor: "#052440",
                fontStyle: 'Normal',
                bodyFontFamily: "Montserrat",
                cornerRadius: 2,
                backgroundColor: "#052440",
                xPadding: 7,
                yPadding: 7,
                caretSize: 5,
                bodySpacing: 10
            }

        }
    });
    var columnctxx = document.getElementById("chart3").getContext('2d');
    var col3 = new Chart(columnctxx, {
        type: 'pie',
        data: data,
        options: {
            showAllTooltips: true,
            animation: {
                animateRotate: true,
                animateScale: true
            },
            elements: {
                arc: {
                    borderColor: "#fff"
                }
            },
            title: {
                display: true,
                text: 'Custom Chart Title',
                fontSize: 18,
                padding: 20,
                fontColor: "#999",
                fontStyle: 'Normal',
                fontFamily: "Montserrat",
                fullWidth: true
            },
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    boxWidth: 30,
                    fontColor: "#999",
                    fontFamily: "Montserrat",
                    fullWidth: true
                }
            },
            tooltips: {
                enabled: false,
                bodyFontColor: "#052440",
                fontStyle: 'Normal',
                bodyFontFamily: "Montserrat",
                cornerRadius: 2,
                backgroundColor: "#052440",
                xPadding: 7,
                yPadding: 7,
                caretSize: 5,
                bodySpacing: 10
            }

        }
    });
</script>