@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        .ImgConatiner {
            width: 26px;
            margin-left: 10px;

        }
        .menu-itemNew {
            display: flex;
            align-items: center;
            margin-top: 20px;
            font-weight: 500;
            font-size: 17px;
            color: black;
            text-decoration: none;
            color: black


        }
        .menu-itemNew i {
            text-decoration: none;
            color: black
        }
    </style>
@endsection

@section('content')

    <section class="page-title">
        <h1>المحامين </h1>
    </section>

    @isset($data['lawyer'])
        <section class="lawyer-details">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-9">
                        <div class="main-content">
                            <div class="lawyer-details">
                                <div class="profile-header">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="{{asset($data['lawyer']['img'])}}" alt="Lawyer Image" class="img-fluid" width="100">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="lawyer-card card">
                                                <div class="card-body">
                                                    <div class="card-meta">
                                                        <h5>{{$data['lawyer']['name']}}</h5>
                                                        <p>500 <i class="fas fa-chart-simple"></i></p>
                                                    </div>
                                                    <hr>
                                                    <ul class="row list-feature">
                                                        <li class="col-6">{{$data['lawyer']['title']}} <span><i class="fas fa-user"></i></span></li>
                                                        <li class="col-6">4.5 <span class="rating-star"><i class="fas fa-star"></i></span></li>
                                                        <!-- <li class="col-6">{{implode(',', array_column($data['lawyer']['languages'], 'name'))}} <span><i class="fas fa-globe-europe"></i></span></li> -->
                                                        <li class="col-6">{{$data['lawyer']['country']['name']}} ، {{$data['lawyer']['city']['name']}} <span><i class="fas fa-globe-europe"></i></span></li>
                                                        <li class="col-12">{{implode(',', array_column($data['lawyer']['services'], 'name'))}} <span><i class="fas fa-bag-shopping"></i></span></li>
                                                    </ul>
                                                    <p class="process-description">
                                                        يمكنك طلب استشارة من محامي من هنا.الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك
                                                        القانوني واحصل على إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية،
                                                        أو عن طريق الهاتف. فقط قم باختيار الوسيلة المناسبة لك:
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lawyer-bio">
                                <h5>ملف المحامي</h5>
                                <p class="process-description">{!! $data['lawyer']['file'] !!}</p>
                                <h5>اللغات:</h5>
                                <ul>
                                    @foreach($data['lawyer']['languages'] as $language)
                                        <li>{{$language['name']}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="company-services mt-5">
                                <h3 class="mb-4">خدمات ثابتة التكلفة</h3>
                                <div class="swiper swiper-container company-services-slider overflow-hidden">
                                    <div class="swiper-wrapper">
                                        @foreach ($data['lawyer']['lawyer_prices'] as $blog)
                                            <div class="swiper-slide">
                                                <div class="service-card">
                                                    <h5>{!! $blog['blog']['title'] ?? $blog['blog']['translations'][0]['title'] !!}</h5>
                                                    <p>{!! $blog['blog']['description'] ?? $blog['blog']['translations'][0]['description'] !!}</p>
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <p class="price">USD {{ $blog['price'] }}</p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <a href="{{route('front/fixed-service', [$blog['blog']['id'], $data['lawyer']['id']])}}" class="details-btn">عرض التفاصيل</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- Add more swiper slides as needed -->
                                    </div>
                                    <div class="swiper-pagination"></div>

                                </div>
                            </div>
                            <div class="lawyer-activity">
                                <div class="activity-header">
                                    <h4>النشاط</h4>
                                    <p>500 <i class="fas fa-chart-line"></i></p>
                                </div>
                                <h5 class="text-center">تم تسليم الخدمات المدفوعة</h5>
                                <h1 class="text-center">250</h1>
                                <div class="rating-progress">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            <span class="star"><i class="fas fa-star"></i></span>
                                            <span>5</span>
                                        </div>
                                        <div class="col-lg-6 text-left">
                                            <span class="star"><i class="fas fa-star"></i></span>
                                            <span>1</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>
                                <div class="chart-container">
                                    <div>
                                        <p class="text-center">إجراء المكالمات الهاتفية المطلوبة</p>
                                        <canvas id="chart1"></canvas>
                                    </div>
                                    <div>
                                        <p class="text-center">الرد على طلبات المحادثة</p>
                                        <canvas id="chart2" width="150" height="150"></canvas>
                                    </div>
                                    <div>
                                        <p class="text-center">إجابة الأسئلة العامة</p>
                                        <canvas id="chart3"></canvas>
                                    </div>
                                </div>
                                <div class="rating-progress">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-6">
                                            <span class="star"><i class="fas fa-thumbs-up"></i></span>
                                            <span>5</span>
                                        </div>
                                        <div class="col-lg-6 text-left">
                                            <span class="star"><i class="fas fa-thumbs-down"></i></span>
                                            <span>1</span>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                </div>
                            </div>
                            <div class="customer-reviews">
                                <h4>تقييمات العملاء</h4>
                                <h5><i class="fas fa-star"></i> 4.5 بناءً على 24 من التقييمات </h5>
                                <div class="review">
                                    <p><i class="fa-regular fa-building"></i><strong>لوريم إيبسوم</strong> <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                    <p>لوريم إيبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور.</p>
                                </div>
                                <div class="review">
                                    <p><i class="fa-regular fa-building"></i><strong>لوريم إيبسوم</strong> <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                    <p>لوريم إيبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور.</p>
                                </div>
                                <div class="review">
                                    <p><i class="fa-regular fa-building"></i><strong>لوريم إيبسوم</strong> <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                    <p>لوريم إيبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور.</p>
                                </div>
                            </div>
                            <div class="card review-card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>اجوبة حديثة</h5>
                                    <a href="#">رؤية الكل</a>
                                </div>
                                <div class="card-body">
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 sidebar">
                        <div class="h-100">
                            <div class="position-sticky sticky-top">
                                <div class="profile-sidebar">
                                    <h4>{{$data['lawyer']['name'] ?? 'lawyer name'}}</h4>
                                    @foreach($data['services'] as $service)
                                        <div>
                                            <a  class="menu-itemNew" href="{{route('front/services', ['id' => $service['id'], 'lawyer_id' => $data['lawyer']['id']])}}">
                                                <div class="ImgConatiner">
                                                    <img src="{{asset($service['icon'])}}" alt="">
                                                </div>
                                                <span>{{$service['name']}}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="lawyer-list">
                                    <h5>محام متصل</h5>
                                    <div class="lawyer-item">
                                        <img src="{{asset('front/assets/img/person.png')}}" alt="Lawyer Image">
                                        <div class="content">
                                            <p class="title">محمد احمد ابراهيم</p>
                                            <p class="sub-title">
                                                جمهورية مصر العربية
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lawyer-item">
                                        <img src="{{asset('front/assets/img/person.png')}}" alt="Lawyer Image">
                                        <div class="content">
                                            <p class="title">محمد احمد ابراهيم</p>
                                            <p class="sub-title">
                                                جمهورية مصر العربية
                                            </p>
                                        </div>
                                    </div>
                                    <div class="lawyer-item">
                                        <img src="{{asset('front/assets/img/person.png')}}" alt="Lawyer Image">
                                        <div class="content">
                                            <p class="title">محمد احمد ابراهيم</p>
                                            <p class="sub-title">
                                                جمهورية مصر العربية
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#get-lawyer').addClass('active');
    </script>
@endsection
@section('script')
    <script>
        var swiper = new Swiper('.company-services .company-services-slider', {
            slidesPerView: 2,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 50,
                },
            },
        });
    </script>
@endsection
