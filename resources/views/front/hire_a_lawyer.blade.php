@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>اختار محام </h1>
    </section>

    <section class="process-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                </div>
                <div class="col-md-8 process-content">
                    <h2 class="process-title">اختار محام </h2>
                    <p class="process-description">
                        يمكنك طلب استشارة من محامي من هنا.الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك القانوني واحصل على
                        إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                        باختيار الوسيلة المناسبة لك: </p>
                </div>
            </div>

        </div>
    </section>

    <section class="department style-two sec-pad-top sec-pad-bottom">
        <div class="container-fluid custom-container">
            <div class="other">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <a href="{{route('front/lawyers')}}" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/lawyers.png')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>المحامين</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <a href="{{route('front/companies')}}" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/fairness_12459810.png')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>شركات المحاماه</p>
                                </div>
                            </a>
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