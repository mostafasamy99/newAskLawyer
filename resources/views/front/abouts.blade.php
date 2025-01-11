@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>عن الشركة</h1>
    </section>

    @isset($data['sections_abouts'])
        @foreach($data['sections_abouts'] as $section) 
            <section class="about-section sec-pad-top sec-pad-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        @if($section['img_dir'] == 1)
                            <div class="col-md-6 about-images">
                                <img src="{{asset($section['img'])}}" class="img-fluid big-img" alt="Image 1">
                            </div>
                        @endif
                        <div class="{{$section['img_dir'] ? 'col-md-6' : ''}} content-box">
                            <p>{!! $section['content'] !!}</p>
                        </div>
                        @if($section['img_dir'] == 2)
                            <div class="col-md-6 about-images">
                                <img src="{{asset($section['img'])}}" class="img-fluid big-img" alt="Image 1">
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach
    @endisset

    <section class="counters-section">
        <div class="container counters-content">
            <div class="frame">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-4">
                        <div class="counter">
                            <div class="bg-circle"></div>
                            <div class="count" data-count="60">+0</div>
                            <p>المحامون المحترفون</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="counter">
                            <div class="bg-circle"></div>
                            <div class="count" data-count="95">0%</div>
                            <p>القضايا الناجحة</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="counter">
                            <div class="bg-circle"></div>

                            <div class="count" data-count="1000">+0</div>
                            <p>استشارات العملاء</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @isset($data['why_us_abouts'])
        <section class="testmonials-area">
            <div class="container">
                <h2>لماذا يختارنا العملاء؟</h2>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        @foreach($data['why_us_abouts'] as $why_us) 
                            <div class="swiper-slide">
                                <p>{!! $why_us['content'] !!}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
    @endisset

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#about-us').addClass('active');
    </script>
@endsection
@section('script')
@endsection