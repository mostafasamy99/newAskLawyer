@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
<style>
    .postedCustom {
        display: flex;
        gap:6px;
    }
    .postedCustom span {
        background: rgba(209, 176, 107, 1);
        border-radius: 5px;
        padding: 7px;
        width: fit-content;
        padding: 0 20px;
        color: white;
    }
    .postedCustom .first {
        background: #3d8b40 !important;
    }
    .postedCustom .first .custom-link {
        color: white;
        text-decoration: none;
    }

 </style>
@endsection

@section('content')

    <div class="row position-relative" style="margin-top: 40px;">
        <div class="col-lg-12">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            ترتيب حسب التاريخ
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">الأحدث</a></li>
                            <li><a class="dropdown-item" href="#">الأقدم</a></li>
                        </ul>
                    </div>
                    <a class="btn btn-primary" href="{{route('dashboard/blogs/add')}}">مقالة جديدة</a>
                </div>

                <div class="faq-section">
                    @if ($data['blogs'])
                        @foreach ($data['blogs'] as $blog)
                            <div class="faq-item">
                                <div class="postedCustom d-flex">
                                    <span class="first"><a class="custom-link" href="{{route('dashboard/blogs/edit', $blog['id'])}}">تعديل</a></span>
                                    <span>{{(int)$blog['is_publish'] == 1 ? 'تم النشر' : 'تحت المراجعه'}}</span>
                                </div>
                                <a href="../legal-blog-details.html">
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
                                            <span>{{date('Y-m-d', strtotime($blog['created_at']))}}</span>
                                        </div>
                                    </div>
                                    <div class="faq-body">
                                        <p>{{$blog['description']}}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @else
                        {{-- <a href="../legal-blog-details.html" class="faq-item">
                        </a> --}}
                        <div class="faq-item">
                            <p>لا توجد مقالات</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection

<!-- custom js -->
@section('scriptAddClassDash')

@endsection
@section('script')
@endsection
