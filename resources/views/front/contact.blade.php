@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>اتصل بنا</h1>
    </section>

    <div class="container" style="margin-top: 25px;">@include('flash::message')</div>
    <section class="contact-info-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <div class="icon">
                            <img src="./assets/img/at.svg" alt="">
                        </div>
                        <h5>البريد الإلكتروني</h5>
                        <p>{{$data['settings'] ? $data['settings']['email'] : 'info@AskLawyer.com'}}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <div class="icon">
                            <i class="fas fa-phone-volume"></i>
                        </div>
                        <h5>رقم الاتصال</h5>
                        <p>{{$data['settings'] ? $data['settings']['mobile'] : '01007347171'}}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <div class="icon">
                            <img src="./assets/img/location.svg" alt="">
                        </div>
                        <h5>العنوان</h5>
                        <p>{{$data['settings'] ? $data['settings']['location'] : '39 شارع أسماء فهمى، أرض الجولف خلف الرقابة الادارية'}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section sec-pad-top sec-pad-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div style="text-align: left; margin: 15px;">
                            <ul dir="ltr">
                                @foreach ($errors->all() as $error)
                                    <li class="text-danger">{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h2 class="section-title">اتصل بنا</h2>
                    <form class="contact-form" action="{{route('contact/store')}}" method="post">
                        @csrf
                        <div class="row">
                            <input name="page" value="1" type="hidden">
                            <div class="col-md-6">
                                <input name="mobile" type="text" class="form-control" placeholder="رقم التواصل">
                            </div>
                            <div class="col-md-6">
                                <input name="name" type="text" class="form-control" placeholder="الاسم">
                            </div>
                            <div class="col-md-6">
                                <input name="email" type="email" class="form-control" placeholder="البريد الإلكتروني">
                            </div>
                            <div class="col-md-6">
                                <input name="subject" type="text" class="form-control" placeholder="الموضوع">
                            </div>
                            <div class="col-lg-12">
                                <textarea name="content" class="form-control" placeholder="رسالتك"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#contacts').addClass('active');
    </script>
@endsection
@section('script')
@endsection