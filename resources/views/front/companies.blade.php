@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>شركات المحاماه </h1>
    </section>

    <section class="lawyers-area">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9 main-content">
                    <div class=" process-content">
                        <h2 class="process-title">شركات المحاماه </h2>
                        <p class="process-description">
                            يمكنك طلب استشارة من محامي من هنا. الخدمة مجانية وهويتك مخفاة. لا حاجة للتسجيل. اسأل سؤالك القانوني واحصل
                            على إجابة بالمجان من أحد المحامين، من خلال قسم الأسئلة والأجوبة، الدردشة الحية، أو عن طريق الهاتف. فقط قم
                            باختيار الوسيلة المناسبة لك.
                        </p>
                    </div>
                    @isset($data['companies'])
                        <div class="sort-select">
                            <select class="form-control">
                                <option>ترتيب حسب الاعلي تصنيف</option>
                                <option>ترتيب حسب السعر تنازلي</option>
                            </select>
                        </div>
                        <div class="row">
                            @foreach($data['companies'] as $company)
                                <div class="col-md-4">
                                    <div class="lawyer-card card">
                                        <img src="{{asset($company['img'])}}" alt="Lawyer Image" class="img-fluid">
                                        <div class="card-body">
                                            <div class="card-meta">
                                                <h5>{{$company['name']}}</h5>
                                                <p>500 <i class="fas fa-chart-simple"></i></p>
                                            </div>
                                            <hr>
                                            <ul class="row list-feature">
                                                <li class="col">{{$company['title']}} <span><i class="fas fa-user"></i></span></li>
                                                <li class="col">4.5 <span class="rating-star"><i class="fas fa-star"></i></span></li>
                                                <li class="col-12 text-truncate">{{implode(',', array_column($company['languages'], 'name'))}} <span><i class="fas fa-globe-europe"></i></span></li>
                                                <li class="col">{{$company['country']['name']}} ، {{$company['city']['name']}} <span><i class="fas fa-globe-europe"></i></span></li>
                                                <li class="col-12 text-truncate">{{implode(',', array_column($company['services'], 'name'))}} <span><i class="fas fa-bag-shopping"></i></span></li>
                                            </ul>
                                            <a href="{{route('front/company', $company['id'])}}" class="details-btn">التفاصيل</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

                                {{-- <li class="page-item"><a class="page-link" href="#">10</a></li>
                                <li class="page-item"><span class="page-link">...</span></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li> --}}
                                
                                @php
                                    $companies_count = $data['companies_count'] / PAGINATION_COUNT_FRONT;
                                @endphp
                                @for ($i = 1; $i <= $companies_count; $i++)
                                    <li class="page-item {{ $page == $i ? ' active' : '' }}">
                                        <a class="page-link" href="{{route('front/companies', $i)}}">{{ $i }}</a>
                                    </li>
                                @endfor

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
                    @endisset

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
        $('#sub-menu-item').addClass('active');
    </script>
@endsection
@section('script')
@endsection