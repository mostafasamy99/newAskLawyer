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
                        <form action="{{ route('reset_password_user_check',$email) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="password-consultant" placeholder="أدخل كلمة المرور">
                                <span class="toggle-password far fa-eye-slash" onclick="togglePasswordVisibility('password-client')"></span>
                                                        </div>
                            <div class="form-group">
                                <input type="password" name="password_confirmation" class="form-control" id="password-consultant" placeholder="تأكيد كلمة المرور">
                                <span class="toggle-password far fa-eye-slash" onclick="togglePasswordVisibility('password-client')"></span>
                            </div>
\
                            <button class="btn btn-outline-primary w-100 bg-dark-blue more-button">تحقق</button>

                        </form>


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
