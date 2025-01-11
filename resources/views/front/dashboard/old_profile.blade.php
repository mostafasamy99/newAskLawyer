@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <div class="layout">
        <main class="content">
            <div class="head-content">

                <div class="topbar">
                    <div class="icons">
                        <i class="far fa-sync-alt"></i>
                        <i class="far fa-filter"></i>
                        <i class="far fa-undo"></i>
                    </div>
                    <div class="search">
                        <i class="far fa-search"></i>
                        <input type="text" placeholder="بحث">
                    </div>
                    <div>
                        <a id="btn-toggle" href="#" class="sidebar-toggler break-point-sm">
                            <i class="far fa-bars"></i>
                        </a>
                        <a id="btn-collapse" class="sidebar-collapser d-block d-xl-none d-lg-none d-md-block d-xs-block">
                            <i class="far fa-bars"></i>
                        </a>
                        <span>الاعدادات</span>
                    </div>
                </div>
                
                <div class="row position-relative">

                    <div class="col-lg-12">
                        <div class="container">
                            <div class="user-settings pt-3">
                                <div class="user-profile">
                                    <img src="{{asset(auth()->guard('lawyer')->user()->img ?? auth()->guard('web')->user()->image)}}" alt="User Avatar">
                                    <div class="user-info">
                                        <span class="name">{{auth()->guard('lawyer')->user()->name ?? auth()->guard('web')->user()->name}}</span>
                                        <span class="subscription">مستوى الاشتراك: Enterprise</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <a href="#"
                                                    class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-container">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                        <span class="ms-3">الملف الشخصي</span>
                                                    </div>
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="subescribe.html"
                                                    class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-container">
                                                            <i class="fas fa-file-alt"></i>
                                                        </div>
                                                        <span class="ms-3">خطة الاشتراك</span>
                                                    </div>
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="reset-password.html"
                                                    class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-container">
                                                            <i class="fas fa-key"></i>
                                                        </div>
                                                        <span class="ms-3">إعادة ضبط كلمة السر</span>
                                                    </div>
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="#change-language"
                                                    class="d-flex align-items-center justify-content-between w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon-container">
                                                            <i class="fas fa-globe"></i>
                                                        </div>
                                                        <span class="ms-3">تغيير اللغة</span>
                                                    </div>
                                                    <i class="fas fa-chevron-left"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <div class="overlay"></div>
    </div>
@endsection

<!-- custom js -->
@section('script')
@endsection
