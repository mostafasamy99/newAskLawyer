@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>طلب دردشة</h1>
    </section>

    <section class="process-section">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-md-12">
                    <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                </div>
                <div class="col-md-8 process-content">
                    <h2 class="process-title">طلب دردشة</h2>
                    <p class="process-description">
                        يمكنك طلب استشارة من محامي من هنا.الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك القانوني واحصل على
                        إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                        باختيار الوسيلة المناسبة لك: </p>
                </div>
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
                            <form>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="الاسم">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="اللقب">
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <select class="form-control select">
                                            <option selected>الدولة</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control select">
                                            <option selected>المحامي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <select class="form-control select">
                                            <option selected>الفئة</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" placeholder="البريد الالكتروني">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control form-textarea" placeholder="رسالتك"></textarea>
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
@endsection