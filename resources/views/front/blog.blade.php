@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    @isset($data['blog'])
        <section class="page-title">
            <h1>@if($data['blog']['added_by_type'] == 1) {{'المدونة القانونية'}} @else {{'مدونة الشركة'}} @endif</h1>
        </section>
 
        <section class="lawyer-details">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-9">
                        <div class="main-content">
                            <div class="card blog-card">
                                <img src="{{asset($data['blog']['img'])}}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data['blog']['title'] ?? $data['blog']['translations'][0]['title'] }}</h5>
                                    <div class="card-icons">
                                        <span><i class="fas fa-eye"></i> 4</span>
                                        <span><i class="fas fa-briefcase"></i> {{$data['blog']['section']['name'] ?? 'section'}}</span>
                                        <span><i class="fas fa-calendar"></i> {{\Carbon\Carbon::parse($data['blog']['created_at'])->format('Y-m-d')}}</span>
                                        <span><i class="fas fa-globe"></i> {{$data['blog']['country']['name'] ?? 'country'}}</span>
                                        {{-- <span><i class="fas fa-globe"></i> عربي، إنجليزي</span> --}}
                                    </div>
                                    <p class="card-text">{!! $data['blog']['content'] ?? $data['blog']['translations'][0]['content'] !!}</p>
                                </div>
                            </div>
                        </div>
                        @if($data['related_blogs'])
                            <div class="card review-card mt-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                <h5>قراءات ذات صلة</h5>
                                    <a href="#">رؤية الكل</a>
                                </div>
                                <div class="card-body">
                                    @php
                                        $lastId = $data['related_blogs'][count($data['related_blogs']) - 1]['id'];
                                    @endphp
                                    @foreach($data['related_blogs'] as $blog)
                                        <a href="{{route('front/blog', $blog['id'])}}" class="btn-anchor">
                                            <p>{{$blog['title']}}</p>
                                        </a>
                                        @if($lastId != $blog['id'])
                                            <hr>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-3 sidebar">
                        <div class="h-100">
                            <div class="position-sticky sticky-top">
                                <div class="lawyer-list">
                                    <h5>محام متصل</h5>
                                    <div class="lawyer-item">
                                        <img src="{{asset('front/assets/img/person.png')}}" alt="Lawyer Image">
                                        <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                    </div>
                                    <div class="lawyer-item">
                                        <img src="{{asset('front/assets/img/person.png')}}" alt="Lawyer Image">
                                        <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                    </div>
                                    <div class="lawyer-item">
                                        <img src="{{asset('front/assets/img/person.png')}}" alt="Lawyer Image">
                                        <p>شركة اسيسور للمحاماة<br><small>جمهورية مصر العربية</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    @endisset

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#legal-info').addClass('active');
    </script>
@endsection
@section('script')
@endsection
