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
                <div class="col-lg-3">
                    <div class="login-form">
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
                        <h2>استعادة كلمة المرور</h2>
                        <p>سيتم ارسال رمز التحقق للبريد الإلكتروني المسجل به</p>
                        <form class="row" action="{{ route('otp_check_lawyer',$email) }}" method="post">
                            @csrf
                            {{-- <input type="hidden" name="email" value="{{ $encrypt_email }}"> --}}
                            <div class="form-group col-3">
                                <input name="n1" type="text" maxlength="1" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <input name="n2" type="text" maxlength="1" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <input name="n3" type="text" maxlength="1" class="form-control">
                            </div>
                            <div class="form-group col-3">
                                <input name="n4" type="text" maxlength="1" class="form-control">
                            </div>
                            <button class="btn btn-outline-primary w-100 bg-dark-blue more-button">تحقق</button>

                        </form>

                        {{-- <p class="mt-3">إعادة إرسال الرمز في <span id="timer">56</span> ثانية</p> --}}

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
