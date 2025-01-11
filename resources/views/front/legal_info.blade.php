@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>معلومات قانونية</h1>
    </section>

    <section class="process-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                </div>
                <div class="col-md-8 process-content">
                    <h2 class="process-title">معلومات قانونية</h2>
                    <p class="process-description">
                        يمكنك طلب استشارة من محامي من هنا.الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك القانوني واحصل على
                        إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                        باختيار الوسيلة المناسبة لك: </p>
                </div>
            </div>

        </div>
    </section>

    <section class="department sec-pad-top sec-pad-bottom">
        <div class="container-fluid custom-container">
            <div class="other">
                <div class="row">
                    @isset($data['subjects'])
                        @foreach($data['subjects'] as $subject)
                            <div class="col">
                                <div class="card">
                                    <a href="{{route('front/subjects', $subject['id'])}}" class="d-block">
                                        <div class="icon-box">
                                            <img src="{{asset($subject['icon'])}}" alt="">
                                        </div>
                                        <div class="content-box">
                                            <p>{{$subject['name']}}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </section>

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#legal-info').addClass('active');
    </script>
@endsection
@section('script')
@endsection