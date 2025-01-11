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
                @isset($data['process']['steps'])
                    <div class="row justify-content-center">
                        @foreach($data['process']['steps'] as $step) 
                            <div class="col-md-2 col-6 mb-4">
                                <div class="step-card {{$data['process']['steps'][0]['id'] == $step['id'] ? 'first' : ''}}">
                                    <p>
                                        <!-- <a href="#"> -->
                                            {{$step['content']}}
                                        <!-- </a> -->
                                    </p>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                @endisset 
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