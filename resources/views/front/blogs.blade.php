@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>@if($type == 'our-blogs') {{'المدونة القانونية'}} @else {{'مدونة الشركة'}} @endif</h1>
    </section>

    <section class="lawyer-details">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9">
                    <div class="main-content">
                        <div class=" process-content">
                            <h2 class="process-title">@if($type == 'our-blogs') {{'المدونة القانونية'}} @else {{'مدونة الشركة'}} @endif</h2>
                            <p class="process-description">
                                يمكنك طلب استشارة من محامي من هنا.الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل.اسأل سؤالك القانوني واحصل
                                على إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط
                                قم باختيار الوسيلة المناسبة لك:
                            </p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0"></h5>
                            <select class="form-select w-auto">
                                <option>ترتيب حسب التاريخ</option>
                                <option>ترتيب حسب التاريخ</option>
                            </select>
                        </div>
                        <div class="faq-section">
                            @if(isset($data['our_blogs']) || isset($data['lawyers_blogs']))
                                @php 
                                    $blogs = isset($data['our_blogs']) ? $data['our_blogs'] : $data['lawyers_blogs'];
                                @endphp
                                @foreach($blogs as $blog)
                                    <a href="{{route('front/blog', $blog['id'])}}" class="faq-item">
                                        <div class="faq-header">
                                            <div>
                                                <i class="fas fa-question-circle icon"></i>
                                                <strong>{{$blog['title']}}</strong>
                                            </div>
                                            <div class="view-count">
                                                <div class="review-faq">
                                                    <span>500</span>
                                                    <i class="fas fa-eye"></i>
                                                </div>
                                                <span>{{\Carbon\Carbon::parse($blog['created_at'])->format('Y-m-d')}}</span>
                                            </div>
                                        </div>
                                        <div class="faq-body">
                                            <p>{{$blog['description']}}</p>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">

                            <div class="lawyer-list">
                                <h5>محام متصل</h5>
                                <div class="lawyer-item">
                                    <img src="./assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                                <div class="lawyer-item">
                                    <img src="./assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png" alt="Lawyer Image">
                                    <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                </div>
                                <div class="lawyer-item">
                                    <img src="./assets/img/c8e0bed2a54be2fc8b5f25199ce68915.png" alt="Lawyer Image">
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
        $('#legal-info').addClass('active');
    </script>
@endsection
@section('script')
@endsection