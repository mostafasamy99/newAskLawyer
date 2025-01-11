@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        .accordion-button::after {
            margin-right: auto !important;
            margin-left: 0px;
            color: rgb(226, 172, 108) !important;
        }
        .accordion-button:focus {
            box-shadow: rgb(226, 172, 108);
        }
        .accordion-button:focus {
            z-index: 3;
            border-color: rgb(226, 172, 108) !important;
            outline: 0;
            box-shadow: rgb(212, 212, 212) !important;
        }
        .accordion-button:not(.collapsed) {
            color: rgb(226, 172, 108);
            background-color: #052440 !important;
        }
        .accordion-button {
            color: rgb(226, 172, 108) !important;
        }
        .textDote li{
            list-style: circle;
        }
        .accordion-item .accordion-item-area {
            padding: 10px;
            font-size: 11px;
        }
        .accordion-item ul {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single {
            border: none;
            width: 100%;
            border-radius: 10px;
            height: 40px;
            background-color: rgba(235, 238, 242, 0.8);
            display: flex;
            align-items: center;
        }
        .select2-container {
            width: 100% !important;
            direction: rtl;

        }
        /* .select2-container .select2-selection--single .select2-selection__rendered {
            background-color: rgba(235, 238, 242, 0.8) !important;

        } */
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            padding-right: 15px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            left: 1px;
            right: unset;
            top: 0;
            height: 100%;
        }

    </style>
@endsection

@section('content')
    <section class="lawyer-details">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="main-content">
                        <div class="faq-section">
                            @foreach ($data['blogs_fixed_service'] as $blog)
                                <a href="{{route('front/fixed-service', $blog['id'])}}" class="faq-item">
                                    <div class="faq-header">
                                        <div>
                                            <i class="fas fa-question-circle icon"></i>
                                            <strong>{!! $blog['title'] ?? $blog['translations'][0]['title'] !!}</strong>
                                        </div>
                                        <div class="view-count">
                                            <div class="review-faq">
                                                <span>USD {{ $blog['price'] }}</span>
                                                {{-- <i class="fas fa-eye"></i> --}}
                                            </div>
                                            <span>{{ date('Y-m-d', strtotime($blog['created_at'])) }}</span>
                                        </div>
                                    </div>
                                    <div class="faq-body">
                                        <p>{!! $blog['description'] ?? $blog['translations'][0]['description'] !!}</p>
                                    </div>
                                </a>
                            @endforeach
                            <div class="faq-header mt-5">
                                <div>
                                    <i class="fas fa-question-circle icon"></i>
                                    <strong>ليس هذا ما تحتاجه؟</strong>
                                </div>
                                <div class="view-count">
                                    <div class="review-faq">
                                        <a href="{{ route('front/all-service',8) }}" class="btn btn-request float-left">أحصل علي عروض أسعار</a>
                                    </div>
                                </div>
                                    <div class="faq-body">
                                        <p>أطلب عروض اسعار من المحامين قم بوصف احتياجتك وأرسل طلبك واحصل علي عروض من المحامين</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">

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
@endsection
