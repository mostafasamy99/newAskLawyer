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
                            <img src="{{ asset('front/assets/img/shape.svg') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="login-form">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-lawyer-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-lawyer" type="button" role="tab" aria-controls="pills-lawyer"
                                    aria-selected="true">محام</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-consultant-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-consultant" type="button" role="tab"
                                    aria-controls="pills-consultant" aria-selected="false">مستشار قانوني</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-client-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-client" type="button" role="tab" aria-controls="pills-client"
                                    aria-selected="false">موكل</button>
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
                            <div class="tab-pane fade show active" id="pills-lawyer" role="tabpanel"
                                aria-labelledby="pills-lawyer-tab">
                                <h2>انشاء حساب</h2>
                                <div class="container steps-hirinig">
                                    <!-- Steps Progress Bar -->
                                    <!-- <div class="steps-progress">
                                        <ul id="progressbar">
                                            <li class="step active" data-step="1">الشروط</li>
                                            <li class="step" data-step="2">تواصل</li>
                                            <li class="step" data-step="3">الدفع</li>
                                            <li class="step" data-step="4">إنهاء</li>
                                        </ul>
                                    </div> -->

                                    <!-- Steps Content -->
                                    <div class="steps-content">
                                        <form role="form" method="POST" action="{{route('dashboard/registerStoreLawyer')}}" enctype="multipart/form-data">
                                        <div class="step-content active" data-step="1">
                                            <input type="hidden" name="type" value="1">
                                            <div class="form-container">
                                                <h2 class="ask-gold">معلومات المحامي</h2>
                                                    @csrf
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="الاسم">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="اللقب">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="البريد الإلكتروني">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="password" value="{{old('password')}}" type="password" class="form-control" id="password-consultant"
                                                            placeholder="أدخل كلمة المرور">
                                                        <span class="toggle-password far fa-eye-slash"
                                                            onclick="togglePasswordVisibility('password-client')"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="form-control" id="password-consultant"
                                                            placeholder="تأكيد كلمة المرور">
                                                        <span class="toggle-password far fa-eye-slash"
                                                            onclick="togglePasswordVisibility('password-client')"></span>
                                                    </div>
                                                    <div class="col">
                                                            <div class="form-group">
                                                                <input name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="رقم الهاتف">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                        <label for="countries"> الدولة </label>
                                                        <select class="form-control" name="country_id" id="countries">
                                                                <option selected disabled>الدولة</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label for="cities"> المدينة </label>
                                                            <select class="form-control" name="city_id" id="cities" style="width: 100%">
                                                                <option selected disabled value="المدينة"></option>
                                                            </select>
                                                            {{-- <input type="text" name="city_id" class="form-control" placeholder="المدينة"> --}}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="العنوان"/>

                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <textarea name="file" class="form-control" placeholder="الملفات">{{old('file')}}    </textarea>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <!-- <div class="col">
                                                            <button type="button" class="btn btn-outline-primary w-100 bg-dark-blue more-button">السابق</button>
                                                        </div> -->
                                                        <div class="col">
                                                            <a href="javascript:void(0);" class="btn btn-outline-primary w-100 bg-dark-blue more-button next-step font-white text-white">التالي</a>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="step-content" data-step="2">
                                            <div class="form-container send-ques-detail">
                                                {{-- <form> --}}
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <label>المجال القانوني</label>
                                                            <select class="form-control" name="legal_fields[]" id="legal_fields" multiple style="width: 100%;display: block">
                                                                @isset($user->legal_fields)
                                                                    @foreach($user->legal_fields as $legal_field)
                                                                        <option value="{{ $legal_field->id }}" selected>{{ $legal_field->name }}</option>
                                                                    @endforeach
                                                                @endisset
                                                            </select>
                                                            {{-- <input type="text" name="legal_field" class="form-control" placeholder="المجال القانوني"/> --}}
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <input type="text" name="registration_number" value="{{old('registration_number')}}" class="form-control" placeholder="رقم القيد"/>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <input type="text" name="education" value="{{old('education')}}" class="form-control" placeholder="التعليم"/>

                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="form-group">
                                                            <input type="text" name="medals" value="{{old('medals')}}" class="form-control" placeholder="الاوسمه"/>

                                                        </div>
                                                    </div>

                                                    <div class="row mt-4">
                                                        <div class="col text-right">
                                                            <a href="javascript:void(0);"
                                                                class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white prev-step">

                                                                السابق

                                                            </a>
                                                        </div>
                                                        <div class="col text-left">
                                                            <a href="javascript:void(0);"  class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white next-step">
                                                                التالي

                                                            </a>
                                                        </div>

                                                    </div>
                                                {{-- </form> --}}
                                            </div>
                                        </div>
                                        <div class="step-content" data-step="3">

                                            <h2 class="mt-4">معلومات شركة المحاماة</h2>

                                            <div class="form-group">
                                                <input type="text" name="website_company" value="{{old('website_company')}}" class="form-control" placeholder="الموقع الإلكتروني للشركة">
                                            </div>
                                            <div class="mb-3 ">
                                                <label for="countries-2"> الدولة </label>
                                                <select class="form-control" name="country_id_company" id="countries-2" style="width: 100%">
                                                    <option selected disabled value="">الدولة</option>
                                                </select>
                                            </div>
                                            {{-- <div class=" mb-3">
                                            </div> --}}
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <label for="cities-2"> المدينة </label>
                                                    <select class="form-control" name="city_id_company" id="cities-2" style="width: 100%">
                                                        <option selected disabled value="المدينة"></option>
                                                    </select>
                                                    {{-- <input type="text" name="city_id" class="form-control" placeholder="المدينة"> --}}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-group">
                                                    <input type="text" name="linked_in_company" value="{{old('linked_in_company')}}" class="form-control" placeholder="حساب لينكد إن">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-group">

                                                <input type="text" name="address_company" value="{{old('address_company')}}" class="form-control" placeholder="عنوان شركة المحاماة">
                                                </div>
                                            </div>


                                            <div class="row mt-4">
                                                <div class="col">
                                                    <a href="javascript:void(0);"
                                                        class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white prev-step">

                                                        السابق

                                                    </a>
                                                </div>
                                                <div class="col text-left">
                                                    <a href="javascript:void(0);"  class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white next-step">
                                                        التالي

                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="step-content" data-step="4">
                                            <div class="form-container send-ques-detail">
                                                <div class="form-container send-ques-detail">
                                                    <div>
                                                    <div class="form-title text-end"> صورة كارنيه النقابة :  </div>
                                                    <div class="form-group mt-4">
                                                        <div class="drop-zone">
                                                            <label for="documents_union_card" class="drop-zone__prompt">
                                                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                اسحب ملفك (ملفاتك)
                                                            </label>
                                                            <label for="documents_union_card" class="text-muted">
                                                                20ميجابايت بحد اقصى
                                                            </label>
                                                            <input type="file" name="photo_union_card"  id="documents_union_card"
                                                                class="drop-zone__input" multiple>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div>
                                                    {{-- <div class="form-title text-end"> عقد ايجار المكتب:  </div>
                                                    <div class="form-group mt-4">
                                                        <div class="drop-zone">
                                                            <label for="documents" class="drop-zone__prompt">
                                                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                اسحب ملفك (ملفاتك)
                                                            </label>
                                                            <label for="documents" class="text-muted">
                                                                20ميجابايت بحد اقصى
                                                            </label>
                                                            <input type="file" name="documents" id="documents"
                                                                class="drop-zone__input" multiple>
                                                        </div>
                                                    </div> --}}
                                                </div>

                                                {{-- <div class="form-group mt-4">
                                                    <label for="documents" class="text-end">صورة جواز السفر :</label>
                                                    <div class="drop-zone">
                                                        <label for="documents" class="drop-zone__prompt">
                                                            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                            اسحب ملفك (ملفاتك)
                                                        </label>
                                                        <label for="documents" class="text-muted">
                                                            20ميجابايت بحد اقصى
                                                        </label>
                                                        <input type="file" name="documents" id="documents"
                                                            class="drop-zone__input" multiple>
                                                    </div>
                                                </div> --}}

                                                {{-- <div class="form-group mt-4">
                                                    <label for="documents" class="text-end">صورة جواز السفر :</label>
                                                    <div class="drop-zone">
                                                        <label for="documents" class="drop-zone__prompt">
                                                            <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                            اسحب ملفك (ملفاتك)
                                                        </label>
                                                        <label for="documents" class="text-muted">
                                                            20ميجابايت بحد اقصى
                                                        </label>
                                                        <input type="file" name="documents" id="documents"
                                                            class="drop-zone__input" multiple>
                                                    </div>
                                                </div> --}}
                                            </div>



                                                    <div class="row mt-4">
                                                        <div class="col">
                                                            <a href="javascript:void(0);"
                                                            class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white prev-step">

                                                                السابق
                                                            </a>
                                                        </div>
                                                        <div class="col text-left">
                                                            <button href="javascript:void(0);" class=" btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white"
                                                                data-bs-toggle="modal" data-bs-target="#customModal">
                                                                انهاء

                                                            </button>
                                                        </div>
                                                    </div>


                                            </div>
                                        </div>
                                    </form>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-consultant" role="tabpanel"  aria-labelledby="pills-consultant-tab">

                                <div class="container steps-hirinig">
                                <h2>انشاء حساب كمستشار قانوني</h2>
                                <div class="container steps-hirinig">

                                    <!-- Steps Content -->
                                    <div class="steps-content">
                                        <form role="form" method="POST" action="{{route('dashboard/registerStoreLawyer')}}" enctype="multipart/form-data">
                                            <div class="step-content active" data-step="1">
                                                <input type="hidden" name="type" value="3">
                                                <div class="form-container">
                                                    <h2 class="ask-gold">معلومات المستشار</h2>
                                                        @csrf
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="الاسم">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="اللقب">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="البريد الإلكتروني">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="password" value="{{old('password')}}" type="password" class="form-control" id="password-consultant"
                                                                placeholder="أدخل كلمة المرور">
                                                            <span class="toggle-password far fa-eye-slash"
                                                                onclick="togglePasswordVisibility('password-client')"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input name="password_confirmation" value="{{old('password_confirmation')}}" type="password" class="form-control" id="password-consultant"
                                                                placeholder="تأكيد كلمة المرور">
                                                            <span class="toggle-password far fa-eye-slash"
                                                                onclick="togglePasswordVisibility('password-client')"></span>
                                                        </div>
                                                        <div class="col">
                                                                <div class="form-group">
                                                                    <input name="mobile" value="{{old('mobile')}}" class="form-control" placeholder="رقم الهاتف">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                            <label for="countries"> الدولة </label>
                                                            <select class="form-control" name="country_id" id="countries-3" style="width: 100%">
                                                                    <option selected disabled>الدولة</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label for="cities"> المدينة </label>
                                                                <select class="form-control" name="city_id" id="cities-3" style="width: 100%">
                                                                    <option selected disabled value="المدينة"></option>
                                                                </select>
                                                                {{-- <input type="text" name="city_id" class="form-control" placeholder="المدينة"> --}}
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="العنوان"/>

                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <textarea name="file" class="form-control" placeholder="الملفات">{{old('file')}}    </textarea>

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- <div class="col">
                                                                <button type="button" class="btn btn-outline-primary w-100 bg-dark-blue more-button">السابق</button>
                                                            </div> -->
                                                            <div class="col">
                                                                <a href="javascript:void(0);" class="btn btn-outline-primary w-100 bg-dark-blue more-button next-step font-white text-white">التالي</a>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="step-content" data-step="2">
                                                <div class="form-container send-ques-detail">
                                                    {{-- <form> --}}
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <label>المجال القانوني</label>
                                                                <select class="form-control" name="legal_fields[]" id="legal_fields-2" multiple style="width: 100%;display: block">
                                                                    @isset($user->legal_fields)
                                                                        @foreach($user->legal_fields as $legal_field)
                                                                            <option value="{{ $legal_field->id }}" selected>{{ $legal_field->name }}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </select>
                                                                {{-- <input type="text" name="legal_field" class="form-control" placeholder="المجال القانوني"/> --}}
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="text" name="registration_number" value="{{old('registration_number')}}" class="form-control" placeholder="رقم القيد"/>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="text" name="education" value="{{old('education')}}" class="form-control" placeholder="التعليم"/>

                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-group">
                                                                <input type="text" name="medals" value="{{old('medals')}}" class="form-control" placeholder="الاوسمه"/>

                                                            </div>
                                                        </div>

                                                        <div class="row mt-4">
                                                            <div class="col text-right">
                                                                <a href="javascript:void(0);"
                                                                    class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white prev-step">

                                                                    السابق

                                                                </a>
                                                            </div>
                                                            <div class="col text-left">
                                                                <a href="javascript:void(0);"  class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white next-step">
                                                                    التالي

                                                                </a>
                                                            </div>

                                                        </div>
                                                    {{-- </form> --}}
                                                </div>
                                            </div>
                                            <div class="step-content" data-step="3">
                                                <div class="form-container send-ques-detail">
                                                    <div class="form-container send-ques-detail">
                                                        <div>
                                                        <div class="form-title text-end"> صورة كارنيه النقابة :  </div>
                                                        <div class="form-group mt-4">
                                                            <div class="drop-zone">
                                                                <label for="documents-1" class="drop-zone__prompt">
                                                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                    اسحب ملفك (ملفاتك)
                                                                </label>
                                                                <label for="documents-1" class="text-muted">
                                                                    20ميجابايت بحد اقصى
                                                                </label>
                                                                <input type="file" name="photo_union_card" id="documents-1"
                                                                    class="drop-zone__input" multiple>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div>
                                                        <div class="form-title text-end"> عقد ايجار المكتب:  </div>
                                                        <div class="form-group mt-4">
                                                            <div class="drop-zone">
                                                                <label for="documents-2" class="drop-zone__prompt">
                                                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                    اسحب ملفك (ملفاتك)
                                                                </label>
                                                                <label for="documents-2" class="text-muted">
                                                                    20ميجابايت بحد اقصى
                                                                </label>
                                                                <input type="file" name="photo_office_rent" id="documents-2"
                                                                    class="drop-zone__input" multiple>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        <div class="form-group mt-4">
                                                        <label for="documents-3" class="text-end">صورة جواز السفر :</label>
                                                        <div class="drop-zone">
                                                            <label for="documents-3" class="drop-zone__prompt">
                                                                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                اسحب ملفك (ملفاتك)
                                                            </label>
                                                            <label for="documents-3" class="text-muted">
                                                                20ميجابايت بحد اقصى
                                                            </label>
                                                            <input type="file" name="photo_passport" id="documents-3"
                                                                class="drop-zone__input" multiple>
                                                        </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <a href="javascript:void(0);"
                                                        class="btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white prev-step">

                                                            السابق
                                                        </a>
                                                    </div>
                                                    <div class="col text-left">
                                                        <button href="javascript:void(0);" class=" btn btn-outline-dark w-50 bg-dark-blue  text-white   font-white"
                                                            data-bs-toggle="modal" data-bs-target="#customModal">
                                                            انهاء

                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-client" role="tabpanel"
                                aria-labelledby="pills-client-tab">
                                <h2>انشاء حساب</h2>
                                <form role="form" method="POST" action="{{route('dashboard/registerStoreUser')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" id="email-consultant"
                                            placeholder="أدخل البريد الإلكتروني">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" id="password-consultant"
                                            placeholder="أدخل كلمة المرور">
                                        <span class="toggle-password far fa-eye-slash"
                                            onclick="togglePasswordVisibility('password-client')"></span>
                                    </div>
                                    <div class="form-group">
                                        <input name="password_confirmation" type="password" class="form-control" id="password-consultant"
                                            placeholder="تأكيد كلمة المرور">
                                        <span class="toggle-password far fa-eye-slash"
                                            onclick="togglePasswordVisibility('password-client')"></span>
                                    </div>
                                    <button class="btn btn-outline-primary w-100 bg-dark-blue more-button">دخول</button>

                                    {{-- <div class="text-center mt-2">
                                        <a href="#" class="btn ">
                                            <img src="../assets/img/facebook.svg" alt="">
                                        </a>
                                        <a href="#" class="btn ">
                                            <img src="../assets/img/Google.svg" alt="">

                                        </a>
                                        <a href="#" class="btn">
                                            <img src="../assets/img/linkedin_145807 1.svg" alt="">

                                        </a>
                                    </div> --}}
                                    <div class="text-center mt-3">
                                        <p>
                                            لديك حساب بالفعل؟ <a href="{{ route('dashboard/login') }}">
                                                تسجيل الدخول
                                            </a>
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
    <script>
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
            $('#countries-2').select2({
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
            $('#cities-2').select2({
            ajax: {
                url: "{{ route('get/country/cities') }}",
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term,
                        country: $('#countries-2').val()
                    };
                },
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
            $('#cities').select2({
            ajax: {
                url: "{{ route('get/country/cities') }}",
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term,
                        country: $('#countries').val()
                    };
                },
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
            $('#legal_fields').select2({
            ajax: {
                url: "{{ route('get/legal_fields') }}",
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
            // المستشار
            $('#countries-3').select2({
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
            $('#cities-3').select2({
            ajax: {
                url: "{{ route('get/country/cities') }}",
                dataType: 'json',
                data: function(params) {
                    return {
                        q: params.term,
                        country: $('#countries-3').val()
                    };
                },
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
            $('#legal_fields-2').select2({
            ajax: {
                url: "{{ route('get/legal_fields') }}",
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
    <script>
        $(document).ready(function () {
            $('.next-step').on('click', function () {
                var currentStep = $(this).closest('.step-content').data('step');
                var nextStep = currentStep + 1;

                // إزالة كلاس active من جميع الخطوات
                $('.step-content').removeClass('active');
                // إضافة كلاس active للخطوة التالية
                $('.step-content[data-step="' + nextStep + '"]').addClass('active');

                // تحديث شريط التقدم
                $('#progressbar .step').each(function () {
                    var step = $(this).data('step');
                    if (step < nextStep) {
                        $(this).removeClass('active').addClass('completed');
                    } else if (step == nextStep) {
                        $(this).removeClass('completed').addClass('active');
                    } else {
                        $(this).removeClass('active completed');
                    }
                });
            });

            $('.prev-step').on('click', function () {
                var currentStep = $(this).closest('.step-content').data('step');
                var prevStep = currentStep - 1;

                // إزالة كلاس active من جميع الخطوات
                $('.step-content').removeClass('active');
                // إضافة كلاس active للخطوة السابقة
                $('.step-content[data-step="' + prevStep + '"]').addClass('active');

                // تحديث شريط التقدم
                $('#progressbar .step').each(function () {
                    var step = $(this).data('step');
                    if (step < prevStep) {
                        $(this).removeClass('active').addClass('completed');
                    } else if (step == prevStep) {
                        $(this).removeClass('completed').addClass('active');
                    } else {
                        $(this).removeClass('active completed');
                    }
                });
            });
        });
    </script>
@endsection
