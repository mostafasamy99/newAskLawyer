@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>كيفية سير العملية</h1>
    </section>

    <section class="process-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                </div>
                <div class="col-md-8 process-content">
                    <h2 class="process-title">كيفية سير العملية</h2>
                    <p class="process-description">
                        يمكنك طلب استشارة من محامي من هنا. الخدمة مجانية وهويتك مخفية. لا حاجة للتسجيل. اسأل سؤالك القانوني واحصل
                        على إجابة بالمجان من أحد المحامين. من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                        باختيار الوسيلة المناسبة لك:
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="department sec-pad-top sec-pad-bottom">
        <div class="container-fluid custom-container">
            <div class="other">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <a href="{{route('front/lawyers/process')}}" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/law.png')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>المحامين</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <a href="{{route('front/users/process')}}" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/user.png')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>الوكلاء</p>
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
        $('#process').addClass('active');
    </script>
@endsection
@section('script')
@endsection