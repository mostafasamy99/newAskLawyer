@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>{{$data['service'] ? $data['service']['name'] : ''}}</h1>
    </section>

    <section class="process-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                </div>
                <div class="col-md-8 process-content">
                    <h2 class="process-title">{{$data['service'] ? $data['service']['name'] : ''}}</h2>
                    <p class="process-description">
                        يمكنك طلب استشارة من محام من هنا. الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك القانوني واحصل على
                        إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                        باختيار الوسيلة المناسبة لك:
                    </p>
                </div>
            </div>
            <div class="container" style="margin-top: 25px;">
                @include('flash::message')
                @if ($errors->any())
                    <div style="text-align: left; margin: 15px;">
                        <ul dir="ltr">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <section class="lawyer-details">
        <div class="custom-container container-fluid mt-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="main-content">
                        <div class="form-container send-ques-detail">
                            <div class="form-title text-end">أرسل سؤالاً</div>
                            <form role="form" action="{{route('request/store')}}" method="post">
                                @csrf
                                <input name="service_id" value="{{$data['service'] ? $data['service']['id'] : 0}}" type="hidden">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <input name="username" type="text" class="form-control" placeholder="الاسم">
                                    </div>
                                    <div class="col-md-6">
                                        <input name="title" type="text" class="form-control" placeholder="اللقب">
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        @if($data['lawyer_or_company']) 
                                            <input type="text" class="form-control" value="{{$data['lawyer_or_company']['name']}}" disabled>
                                            <input name="lawyer_id" type="hidden" value="{{$data['lawyer_or_company']['id']}}">
                                        @else
                                            <select class="form-control select" name="lawyer_id" id="lawyers">
                                                <option value="" selected>المحامي</option>
                                            </select>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control select" name="country_id" id="countries">
                                            <option selected>الدولة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <select class="form-control select-control" name="service_id" id="services">
                                            @if($data['service']) 
                                                <option value="{{$data['service']['id']}}" selected>{{$data['service']['name']}}</option>
                                            @else
                                                <option selected>الخدمة</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input name="email" type="email" class="form-control" placeholder="البريد الالكتروني">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea name="message" class="form-control form-textarea" placeholder="رسالتك"></textarea>
                                </div>
                                <button type="submit" class="btn submit-btn">إرسال</button>
                            </form>
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

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#get-lawyer').addClass('active');
    </script>
@endsection
@section('script')
<script>
    $('#lawyers').select2({
        ajax: {
            url: "{{ route('get/lawyers') }}",
            dataType: 'json',
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('#services').select2({
        ajax: {
            url: "{{ route('get/services') }}",
            dataType: 'json',
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                };
            },
            cache: true
        }
    });
    $('#countries').select2({
        ajax: {
            url: "{{ route('get/countries') }}",
            dataType: 'json',
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                };
            },
            cache: true
        }
    });
</script>
@endsection