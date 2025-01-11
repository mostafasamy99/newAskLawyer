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
    <h1>شركات المحاماه </h1>
</section>

@isset($data['company'])
    <section class="lawyer-details">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="main-content">
                        <div class="lawyer-details">
                            <div class="profile-header">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="{{asset($data['company']['img'])}}" alt="Lawyer Image" class="img-fluid" width="100">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="lawyer-card card">
                                            <div class="card-body">
                                                <div class="card-meta">
                                                    <h5>{{$data['company']['name']}}</h5>
                                                    <p>500 <i class="fas fa-chart-simple"></i></p>
                                                </div>
                                                <hr>
                                                <ul class="row list-feature">
                                                    <li class="col-6">{{$data['company']['title']}} <span><i class="fas fa-user"></i></span></li>
                                                    <li class="col-6">4.5 <span class="rating-star"><i class="fas fa-star"></i></span></li>
                                                    <!-- <li class="col-6">{{implode(',', array_column($data['company']['languages'], 'name'))}} <span><i class="fas fa-globe-europe"></i></span></li> -->
                                                    <li class="col-6">{{$data['company']['country']['name']}} ، {{$data['company']['city']['name']}} <span><i class="fas fa-globe-europe"></i></span></li>
                                                    <li class="col-12">{{implode(',', array_column($data['company']['services'], 'name'))}} <span><i class="fas fa-bag-shopping"></i></span></li>
                                                </ul>
                                                <p class="process-description">
                                                    يمكنك طلب استشارة من محامي من هنا.الخدمة مجانية وهويتك مخفاة. لا
                                                    حاجة للتسجيل.اسأل سؤالك القانوني واحصل على إجابة بالمجان من أحد
                                                    المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق
                                                    الهاتف. فقط قم باختيار الوسيلة المناسبة لك:
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="company-details mt-5">
                            <div class="contact-info">
                                <h5 class="mb-3">بيانات الاتصال</h5>
                                <p><i class="fas fa-phone-alt"></i> {{$data['company']['mobile']}}</p>
                                <p><i class="fas fa-map-marker-alt"></i> {{$data['company']['address']}}</p>
                            </div>
                        </div>
                        <div class="lawyer-bio">
                            <h5>ملف المحامي</h5>
                            <p class="process-description">{!! $data['company']['file'] !!}</p>
                            <h5>اللغات:</h5>
                            <ul>
                                @foreach($data['company']['languages'] as $language)
                                    <li>{{$language['name']}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="company-services mt-5">
                            <h3 class="mb-4">خدمات ثابتة التكلفة</h3>
                            <div class="swiper swiper-container company-services-slider overflow-hidden">
                                <div class="swiper-wrapper">
                                    @foreach ($data['company']['lawyer_prices'] as $blog)
                                        <div class="swiper-slide">
                                            <div class="service-card">
                                                <h5>{!! $blog['blog']['title'] ?? $blog['blog']['translations'][0]['title'] !!}</h5>
                                                <p>{!! $blog['blog']['description'] ?? $blog['blog']['translations'][0]['description'] !!}</p>
                                                <div class="row align-items-center">
                                                    <div class="col-lg-6">
                                                        <p class="price">USD {{ $blog['price'] }}</p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <a href="{{route('front/fixed-service', [$blog['blog']['id'], $data['company']['id']])}}" class="details-btn">عرض التفاصيل</a>
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
                        <div class="sidebar">
                            <div class="lawyer-list">
                                <h5>المحامين</h5>
                                <div class="lawyer-item">
                                    <img src="{{asset('front/assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png')}}" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                                <div class="lawyer-item">
                                    <img src="{{asset('front/assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png')}}" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                                <div class="lawyer-item">
                                    <img src="{{asset('front/assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png')}}" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="customer-reviews">
                            <h4>تقييمات العملاء</h4>
                            <h5><i class="fas fa-star"></i> 4.5 بناءً على 24 من التقييمات </h5>
                            <div class="review">
                                <p><i class="fa-regular fa-building"></i><strong>لوريم إيبسوم</strong> <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                <p>لوريم إيبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور.
                                </p>
                            </div>
                            <div class="review">
                                <p><i class="fa-regular fa-building"></i><strong>لوريم إيبسوم</strong> <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                <p>لوريم إيبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور.
                                </p>
                            </div>
                            <div class="review">
                                <p><i class="fa-regular fa-building"></i><strong>لوريم إيبسوم</strong> <span class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></p>
                                <p>لوريم إيبسوم دولار سيت أميت ,كونسيكتيتور أدايبا يسكينج أليايت,سيت دو أيوسمود تيمبور.
                                </p>
                            </div>
                        </div>
                        <div class="card review-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>اجوبة حديثة</h5>
                                <a href="#">رؤية الكل</a>
                            </div>
                            <div class="card-body">
                                <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.
                                </p>
                                <hr>
                                <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.
                                </p>
                                <hr>
                                <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.
                                </p>
                                <hr>
                                <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.
                                </p>
                                <hr>
                                <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">
                            <div class="profile-sidebar">
                                <div class="profile-sidebar">
                                    <h4>{{$data['lawyer']['name'] ?? 'company name'}}</h4>
                                    @foreach($data['services'] as $service)
                                        <div>
                                            <a  class="menu-itemNew" href="{{route('front/services', ['id' => $service['id'], 'lawyer_id' => $data['company']['id']])}}">
                                                <div class="ImgConatiner">
                                                    <img src="{{asset($service['icon'])}}" alt="">
                                                </div>
                                                <span>{{$service['name']}}</span>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="lawyer-list">
                                <h5>محام متصل</h5>
                                <div class="lawyer-item">
                                    <img src="{{asset('front/assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png')}}" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                                <div class="lawyer-item">
                                    <img src="{{asset('front/assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png')}}" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                                <div class="lawyer-item">
                                    <img src="{{asset('front/assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png')}}" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
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
