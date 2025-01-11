@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1> طلب عرض أسعار </h1>
    </section>

    <section class="process-section">
        <div class="container mt-5">
            <div class="row offer-section">
                <div class="col-md-12 offer-content">
                    <div class="offer-icon">
                        <img src="{{asset('front/assets/img/Layer.svg')}}" class="img-fluid" />
                    </div>
                    <h2>احصل على عروض أسعار من محامين مؤهلين</h2>
                    <p>أرسل طلبك للحصول على عروض أسعار واحصل على العديد من العروض التنافسية من محامين مؤهلين.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="lawyers-area">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9 main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">ترتيب حسب السعر</h5>
                        <select class="form-select w-auto">
                            <option>ترتيب حسب السعر</option>
                            <option>ترتيب حسب السعر</option>
                        </select>
                    </div>
                    <div class="row ask-price">
                        @isset($data['service']['blogs'])
                            @foreach($data['service']['blogs'] as $blog)
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-meta">
                                                <div class="icon">
                                                    {{$blog['price']}} USD
                                                </div>
                                                <p class="price">
                                                    <img src="{{asset('front/assets/img/Layer.svg')}}" alt="">
                                                </p>
                                            </div>
                                            <h5 class="card-title">{{$blog['title']}}</h5>
                                            <p class="card-text">{{$blog['description']}}</p>
                                            <hr>
                                            <a href="{{route('front/ask-price', $blog['id'])}}" class="btn btn-more">المزيد</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">10</a></li>
                            <li class="page-item"><span class="page-link">...</span></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">
                            <div class="lawyer-list">
                                <h2 class="process-title">محام متصل </h2>

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