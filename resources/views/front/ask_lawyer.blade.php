@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>اسأل محام</h1>
    </section>

    <section class="process-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                </div>
                <div class="col-md-8 process-content">
                    <h2 class="process-title">اسأل محام</h2>
                    <p class="process-description">
                        يمكنك طلب استشارة من محام من هنا. الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك القانوني واحصل على
                        إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                        باختيار الوسيلة المناسبة لك:
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="department ask-lawyer-page sec-pad-top sec-pad-bottom">
        <div class="container-fluid custom-container">
            <div class="other">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <a href="#" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/Vector.svg')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>أرسل سؤالًا</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <a href="#" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/Vector.svg')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>طلب دردشة</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <a href="#" class="d-block">
                                <div class="icon-box">
                                    <img src="{{asset('front/assets/img/call-white.svg')}}" alt="">
                                </div>
                                <div class="content-box">
                                    <p>احصل على مكالمة مع محام</p>
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