@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>طلب عرض أسعار </h1>
    </section>

    <section class="lawyer-details">
        <div class="container mt-5">
            <div class="row">

                @isset($data['blogs'])
                    <div class="col-md-9">
                        <div class="main-content">
                            <div class="lawyer-details">
                                <div class="profile-header">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="{{asset($data['blogs']['img'] ?? 'front/assets/img/shak-hand.jpg')}}" alt="Lawyer Image" class="img-fluid" width="100">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="lawyer-card card">
                                                <div class="card-body">
                                                    <div class="card-meta">
                                                        <h5>احصل على عروض أسعار من محامين مؤهلين</h5>
                                                    </div>
                                                    <hr>
                                                    <p class="process-description">
                                                        أرسل طلبك للحصول على عروض أسعار واحصل على العديد من العروض التنافسية من محامين مؤهلين. وفر
                                                        الوقت والمال. راجع العروض وقارن بين خبرات وأسعار وتخصصات المحامين للتأكد من توظيفك للمحامي
                                                        المناسب للخدمة القانونية التي تحتاجها.
                                                    </p>
                                                    <div class="deposit-section">
                                                        <div>
                                                            <h3 class="mb-1">مبلغ الايداع المطلوب</h3>
                                                            <p class="amount">USD {{$data['blogs']['price']}}</p>
                                                        </div>
                                                        <button class="btn btn-request">اطلب</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lawyer-bio">
                                <h5>وصف الخدمة</h5>
                                <p class="process-description">{{$data['blogs']['description']}}</p>
                                <button class="btn btn-request float-left">اطلب</button>
                            </div>
                            <div class="lawyer-bio mt-4">
                                <h5>كيفية سير العملية</h5>
                                <p class="process-description">{!! $data['blogs']['content'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">

                            <div class="lawyer-list">
                                <h5>شراء خدمة من</h5>
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

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#get-lawyer').addClass('active');
    </script>
@endsection
@section('script')
@endsection
