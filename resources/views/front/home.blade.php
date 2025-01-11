@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="slider-main">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="img" style="background-image: url(<?php echo asset('front/assets/img/slide.png'); ?>);">
                    </div>
                    <div class="slider-text">
                        <div class="text-buttons">
                            <div class="text">
                                <section class="legal-assistance">
                                    <div class="container">
                                        <h2 class="ask-gold">احصل على مساعدة قانونية عبر الإنترنت</h2>
                                        <p>
                                            يوجد لدينا مجموعة مختارة ومدربة على أعلى المستويات ومتخصصين في مجالات القانون المختلفة وذلك لتقديم
                                            استشارة قانونية فورية بمستوى جديد من الحلول القانونية لعملائنا الكرام عن طريق مستشار قانوني متخصص
                                            في قضية الموكل.
                                        </p>
                                        <a href="#" class="btn btn-lg custom-btn">المزيد</a>
                                    </div>
                                </section>

                            </div>
                        </div>
                        @isset($data['services'])
                            <div class="container-fluid custom-container">
                                <div class="other">
                                    <div class="row">
                                        @foreach($data['services'] as $service)
                                            <div class="col">
                                                <div class="card">
                                                    <a href="{{route('front/services', $service['id'])}}" class="d-block">
                                                        <div class="icon-box">
                                                            <img src="{{asset($service['icon'])}}" alt="">
                                                        </div>
                                                        <div class="content-box">
                                                            <p>{{$service['name']}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endisset
                    </div>

                </div>

                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: 25px;">@include('flash::message')</div>
    @isset($data['about_company'])
        <section class="about-area sec-pad-top sec-pad-bottom">
            <div class="container mt-5 custom-container">
                <div class="row">
                    <div class="col-md-6 image-column">
                        <div class="inner-column">
                            <figure class="image-1">
                                <a href="#" class="lightbox-image" data-fancybox="images">
                                    <img src="{{asset($data['about_company']['img'])}}" class="img-fluid" alt="About Company">
                                </a>
                            </figure>
                        </div>
                    </div>
                    <div class="col-md-6 content-box">
                        <h2 class="section-title">عن الشركة</h2>
                        <p>{!! $data['about_company']['content'] !!}</p>
                        <a class="btn btn-outline-primary more-button" href="{{route('front/about')}}">المزيد</a>
                    </div>

                </div>
            </div>
        </section>
    @endisset

    <section class="download-section">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-6 download-content order-md-2">
                    <h2>قم بتنزيل التطبيق</h2>
                    <button class="btn btn-primary">المزيد</button>
                </div>
                <div class="col-md-4 order-md-1 position-relative">
                    <div class="img-box">
                        <img src="{{asset('front/assets/img/iPhone 12 Mini.png')}}" class="img-fluid phone-image" alt="Phone Image">
                    </div>
                </div>
            </div>
        </div>
    </section>

    @isset($data['our_blogs_home'])
        <section class="blog-site-area sec-pad-top sec-pad-bottom">
            <div class="container mt-5 custom-container">
                <h2 class="section-title m-auto mb-4">المدونة القانونية</h2>
                <div class="row">
                    @foreach($data['our_blogs_home'] as $blog)
                        <div class="col-md-3 mb-2">
                            <a href="{{route('front/blog', $blog['id'])}}" style="display: block;">
                                <div class="card card-custom">
                                    <img src="{{asset($blog['img'])}}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="card-meta">
                                            <img src="{{asset('front/assets/img/Group.svg')}}" class="img-fluid" alt="">
                                            <span>{{\Carbon\Carbon::parse($blog['created_at'])->format('Y-m-d')}}</span>
                                        </div>
                                        <h5 class="card-title">{{ $blog['title'] ?? $blog['translations'][0]['title'] }}</h5>
                                        <p class="card-text">{!! $blog['content'] ?? $blog['translations'][0]['content'] !!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-lg-12 mt-3">
                        <a href="{{route('front/blogs', 'our-blogs')}}" class="btn btn-outline-primary w-auto bg-dark-blue more-button text-center m-auto d-flex" style="justify-content: center; width: fit-content !important;">
                            المزيد
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endisset

    @isset($data['ask_lawyer'])
        <section class="about-area about-area-style-two sec-pad-top sec-pad-bottom">
            <div class="container mt-5 custom-container">
                <div class="row">
                    <div class="col-md-6 image-column">
                        <img src="{{asset($data['ask_lawyer']['img'])}}" class="img-fluid" alt="About Company">

                    </div>
                    <div class="col-md-6 content-box">
                        <p>{!! $data['ask_lawyer']['content'] !!}</p>
                        <button class="btn btn-outline-primary float-left bg-dark-blue more-button">اسأل محام</button>
                    </div>

                </div>
            </div>
        </section>
    @endisset

    @isset($data['lawyers_blogs_home'])
        <section class="legal-artical-area sec-pad-top sec-pad-bottom">
            <div class="container mt-5 custom-container">
                <h2 class="section-title m-auto mb-4">مدونة الشركة</h2>

                <div class="row">
                    @foreach($data['lawyers_blogs_home'] as $blog)
                        <div class="col-md-6 mb-4">
                            <a href="{{route('front/blog', $blog['id'])}}" style="display: block;">
                                <div class="card custom-news-card">
                                    <div class="row no-gutters">

                                        <div class="p-0 col-md-4">
                                            <img src="{{asset($blog['img'])}}" class="card-img-right img-fluid" alt="...">
                                        </div>
                                        <div class="p-0 col-md-8">
                                            <div class="card-body">
                                                <div class="card-meta">
                                                    <img src="{{asset('front/assets/img/Group.svg')}}" class="img-fluid" alt="">
                                                    <span>{{\Carbon\Carbon::parse($blog['created_at'])->format('Y-m-d')}}</span>
                                                </div>
                                                <h5 class="card-title">{{ $blog['title'] ?? $blog['translations'][0]['title'] }}</h5>
                                                <p class="card-text">{!! $blog['content'] ?? $blog['translations'][0]['content'] !!}</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-lg-12">
                        <a href="{{route('front/blogs', 'lawyers-blogs')}}" class="btn btn-outline-primary w-auto more-button text-center m-auto d-flex" style="justify-content: center; width: fit-content !important;">المزيد</a>
                    </div>
                </div>
            </div>
        </section>
    @endisset

    <section class="contact-section sec-pad-top sec-pad-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 contact-image">
                    <div class="inner-col">
                        <figure class="image-1">
                            <img src="{{asset('front/assets/img/contact.png')}}" class="img-fluid" alt="Contact Image">
                        </figure>
                    </div>
                </div>
                <div class="col-md-6">
                    @if ($errors->any())
                        <div style="text-align: left; margin: 15px;">
                            <ul dir="ltr">
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="section-title">اتصل بنا</h2>
                    <form class="contact-form" action="{{route('contact/store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input name="mobile" type="text" class="form-control" placeholder="رقم التواصل">
                            </div>
                            <div class="col-md-6">
                                <input name="name" type="text" class="form-control" placeholder="الاسم">
                            </div>
                            <div class="col-md-6">
                                <input name="email" type="email" class="form-control" placeholder="البريد الإلكتروني">
                            </div>
                            <div class="col-md-6">
                                <input name="subject" type="text" class="form-control" placeholder="الموضوع">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="content" class="form-control" placeholder="رسالتك"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-left">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#home').addClass('active');
    </script>
@endsection
@section('script')
@endsection
