@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <div class="login-container">
        <div class="container-fluid m-0 p-0">
            <div class="row m-0 p-0 align-items-center">
                <div class="col-lg-6 m-0 p-0 position-relative">
                    <div class="login-image">
                        <div class="login-shape">
                            <img src="{{asset('front/assets/img/shape.svg')}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="login-form">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-lawyer-tab" data-bs-toggle="pill" data-bs-target="#pills-lawyer" type="button" role="tab" aria-controls="pills-lawyer" aria-selected="true">محام</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-consultant-tab" data-bs-toggle="pill" data-bs-target="#pills-consultant" type="button" role="tab" aria-controls="pills-consultant" aria-selected="false">مستشار قانوني</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-client-tab" data-bs-toggle="pill" data-bs-target="#pills-client" type="button" role="tab" aria-controls="pills-client" aria-selected="false">موكل</button>
                            </li>
                        </ul>
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
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-lawyer" role="tabpanel" aria-labelledby="pills-lawyer-tab">
                                <h2>تسجيل دخول</h2>
                                <form role="form" method="POST" action="{{url(route('dashboard/loginCheck'))}}">
                                    @csrf
                                    <input name="user_type" type="hidden" value="1">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" id="email-consultant" placeholder="أدخل البريد الإلكتروني">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" id="password-consultant" placeholder="أدخل كلمة المرور">
                                        <span class="toggle-password far fa-eye-slash" onclick="togglePasswordVisibility('password-client')"></span>
                                    </div>
                                    <button class="btn btn-outline-primary w-100 bg-dark-blue more-button">دخول</button>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('forgot_password_lawyer') }}">نسيت كلمة المرور؟</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        أو
                                    </div>
                                    <div class="text-center mt-2">
                                        <a href="#" class="btn ">
                                            <img src="{{asset('front/assets/img/facebook.svg')}}" alt="">
                                        </a>
                                        <a href="#" class="btn ">
                                            <img src="{{asset('front/assets/img/Google.svg')}}" alt="">
                                        </a>
                                        <a href="#" class="btn">
                                            <img src="{{asset('front/assets/img/linkedin_145807 1.svg')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="text-center mt-3">
                                        <p>
                                            ليس لديك حساب؟ <a href="{{ route('dashboard/register') }}">إنشاء حساب</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-consultant" role="tabpanel" aria-labelledby="pills-consultant-tab">
                                <h2>تسجيل دخول</h2>
                                <form role="form" method="POST" action="{{url(route('dashboard/loginCheck'))}}">
                                    @csrf
                                    <input name="user_type" type="hidden" value="1">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" id="email-consultant" placeholder="أدخل البريد الإلكتروني">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" id="password-consultant" placeholder="أدخل كلمة المرور">
                                        <span class="toggle-password far fa-eye-slash" onclick="togglePasswordVisibility('password-client')"></span>
                                    </div>
                                    <button class="btn btn-outline-primary w-100 bg-dark-blue more-button">دخول</button>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('forgot_password_lawyer') }}">نسيت كلمة المرور؟</a>
                                    </div>
                                    <div class="text-center mt-2">
                                        أو
                                    </div>
                                    <div class="text-center mt-2">
                                        <a href="#" class="btn ">
                                            <img src="{{asset('front/assets/img/facebook.svg')}}" alt="">
                                        </a>
                                        <a href="#" class="btn ">
                                            <img src="{{asset('front/assets/img/Google.svg')}}" alt="">
                                        </a>
                                        <a href="#" class="btn">
                                            <img src="{{asset('front/assets/img/linkedin_145807 1.svg')}}" alt="">
                                        </a>
                                    </div>
                                    <div class="text-center mt-3">
                                        <p>
                                            ليس لديك حساب؟ <a href="{{ route('dashboard/register') }}">إنشاء حساب</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-client" role="tabpanel" aria-labelledby="pills-client-tab">
                                <h2>تسجيل دخول</h2>
                                <form role="form" method="POST" action="{{url(route('dashboard/loginCheck'))}}">
                                    @csrf
                                    <input name="user_type" type="hidden" value="2">
                                    <div class="form-group">
                                        <input name="email" type="email" class="form-control" id="email-consultant" placeholder="أدخل البريد الإلكتروني">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" id="password-consultant" placeholder="أدخل كلمة المرور">
                                        <span class="toggle-password far fa-eye-slash" onclick="togglePasswordVisibility('password-client')"></span>
                                    </div>
                                    <button class="btn btn-outline-primary w-100 bg-dark-blue more-button">دخول</button>
                                    <div class="text-center mt-3">
                                        <a href="{{ route('forgot_password_user') }}">نسيت كلمة المرور؟</a>
                                    </div>
                                    {{-- <div class="text-center mt-2">
                                        أو
                                    </div>
                                    <div class="text-center mt-2">
                                        <a href="#" class="btn ">
                                            <img src="{{asset('front/assets/img/facebook.svg')}}" alt="">
                                        </a>
                                        <a href="#" class="btn">
                                            <img src="{{asset('front/assets/img/Google.svg')}}" alt="">

                                        </a>
                                        <a href="#" class="btn">
                                            <img src="{{asset('front/assets/img/linkedin_145807 1.svg')}}" alt="">
                                        </a>
                                    </div> --}}
                                    <div class="text-center mt-3">
                                        <p>
                                            ليس لديك حساب؟ <a href="{{ route('dashboard/register') }}">إنشاء حساب</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#auth').addClass('active');
    </script>
@endsection
@section('script')
@endsection
