@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    @php
        if(auth()->guard('lawyer')->check()){
            $user = auth()->guard('lawyer')->user();
            $user_type = 1;
        }else {
            $user = auth()->guard('web')->user();
            $user_type = 2;
        }
    @endphp
    <div class="container" style="text-align: center; margin-top: 40px;">
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
    </div>
    <div class="row position-relative">

        <div class="col-12 col-md-4">
            <div class="container">
                <div class="user-settings pt-3">
                    <div class="user-profile col-lg-6">
                        <img src="{{ asset(auth()->guard('lawyer')->user()->img ?? auth()->guard('web')->user()->image) }}"
                            alt="User Avatar">
                        <div class="user-info">
                            <span
                                class="name">{{ auth()->guard('lawyer')->user()->name ?? auth()->guard('web')->user()->name }}</span>
                            <span class="subscription">مستوى الاشتراك: Enterprise</span>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li id="sidebar-user-profile" class="list-group-item">
                            <a href="#" class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <div class="icon-container">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <span class="ms-3">الملف الشخصي</span>
                                </div>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>

                        <li id="sidebar-subscription" class="list-group-item">
                            <a href="#" class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <div class="icon-container">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <span class="ms-3">خطة الاشتراك</span>
                                </div>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>

                        <li id="sidebar-reset-password" class="list-group-item">
                            <a href="#" class="d-flex align-items-center justify-content-between w-100">
                                <div class="d-flex align-items-center">
                                    <div class="icon-container">
                                        <i class="fas fa-key"></i>
                                    </div>
                                    <span class="ms-3">إعادة ضبط كلمة السر</span>
                                </div>
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>

                        <li id="sidebar-change-language" class="list-group-item">
                            <a href="#" class="d-flex align-items-center justify-content-between w-100">
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

        <div class="col-12 col-md-8">
            <section id="user-profile" class="profile-container hidden">
                <form class="profile-card form-control">
                    <div class="profile-details">
                        <div class="profile-image-wrapper">
                            <img src="{{ asset('front/assets/img/user.png') }}" alt="Profile"
                                class="profile-image">
                            <img class="camera-icon" src="{{ asset('front/assets/img/camera.svg') }}"/>
                        </div>
                        <div class="profile-dataDetails">
                            <p class="profile-name">{{$user->name}}</p>
                            <p class="profile-job"> {{$user->title}}</p>
                        </div>
                    </div>
                    <button class="edit-button">
                        <img src="{{ asset('front/assets/img/editIcon.png') }}" class="edit-icon"/> تعديل
                    </button>
                </form>
                <form class="profile-form form-control" method="POST" action="{{route('dashboard/update/profile')}}">

                    @csrf
                    <div class="form-header">
                        <button class="edit-button" type="submit">
                            <img src="{{ asset('front/assets/img/editIcon.png') }}" class="edit-icon"/> تعديل
                        </button>
                    </div>
                    <div class="form-container">
                        <div>
                            <label>اللقب</label>
                            <input name="title" value="{{$user?->title}}" placeholder="المستشار"/>
                        </div>
                        <div>
                            <label>الاسم</label>
                            <input name="name" value="{{$user?->name}}" placeholder="محمد احمد صلاح"/>
                        </div>
                    </div>
                    <div class="form-input">
                        <div>
                            <label>البريد الالكتروني</label>
                            <input name="email" value="{{$user?->email}}" placeholder="temp@gmail.com"/>
                        </div>
                    </div>
                    <div class="form-container">
                        <div>
                            <label>الدولة</label>
                            {{-- <select><option>مصر</option></select> --}}
                            <select class="form-control" name="country_id" id="countries">
                                <option value="{{$user->country_id}}">{{$user->country?->name}}</option>
                            </select>
                        </div>
                        <div>
                            <label>المدينة</label>
                            {{-- <select><option>القاهرة</option></select> --}} 
                            <select class="form-control" name="city_id" id="cities">
                                <option value="{{$user->city_id}}">{{$user->city?->name}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-input">
                        <div>
                            <label> العنوان</label>
                            <input name="address" value="{{$user->address}}" placeholder="العنوان"/>
                        </div>
                    </div>
                    <div class="form-input">
                        <div>
                            <label> رقم الهاتف</label>
                            <input name="mobile" value="{{$user->mobile}}" type="text" placeholder="رقم الهاتف"/>
                        </div>
                    </div>

                    @if ($user_type == 1)
                        <div class="form-container">
                            <div>
                                <label>المجال القانوني</label>
                                {{-- <input placeholder="الجنايات ,, الاسرة"/> --}}
                                <select class="form-control" name="legal_fields[]" id="legal_fields" multiple>
                                    @isset($user->legal_fields)
                                        @foreach($user->legal_fields as $legal_field)
                                            <option value="{{ $legal_field->id }}" selected>{{ $legal_field->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div>
                                <label>رقم التسجيل في الوزارة</label>
                                <input name="registration_number" value="{{$user->registration_number}}" placeholder=" رقم التسجيل في الوزارة"/>
                            </div>
                        </div>
                        <div class="form-container">
                            <p>سيتم عرض معلومات القيد في وزارة العدل في ملفك العام</p>
                        </div>
                        <div class="form-input">
                            <div>
                                <label> ملخص</label>
                                <input name="file" value="{{$user->file}}" placeholder="ملخص"/>
                            </div>
                        </div>
                        <div class="form-container">
                            <div>
                                <label>التعليم </label>
                                <input name="education" value="{{$user->education}}" placeholder="التعليم"/>
                            </div>
                            <div>
                                <label> الجمعيات والعضويات</label>
                                <input name="memberships" value="{{$user->memberships}}" placeholder="الجمعيات والعضويات "/>
                            </div>
                        </div>
                        <div class="form-container">
                            <div>
                                <label>الاوسمة </label>
                                <input name="medals" value="{{$user->medals}}" placeholder="الاوسمة"/>
                            </div>
                            <div>
                                <label>اخلاء المسؤولية </label>
                                <input name="disclaimer" value="{{$user->disclaimer}}" placeholder=" اخلاء المسؤولية"/>
                            </div>
                        </div>
                    @endif

                </form>

            </section>

            <section id="reset-password" class="reset-password-container hidden">
                <img src="{{ asset('front/assets/img/logo.svg') }}"/>
                <form class="reset-password-form" method="POST" action="{{route('dashboard/update/profile')}}">
                    @csrf
                    <label>إعادة تعيين كلمة المرور</label>
                    <div class="input-icon-container">
                        <input id="current-password" type="password" placeholder="كلمة المرور الحالية"
                        name="old_password"/>
                        <i class="far fa-eye" id="toggle-current-password"
                            onclick="togglePassword('current-password', 'toggle-current-password')"></i>
                    </div>
                    <div class="input-icon-container">
                        <input id="new-password" type="password" placeholder="كلمة المرور الجديدة"
                        name="password"/>
                        <i class="far fa-eye" id="toggle-new-password"
                            onclick="togglePassword('new-password', 'toggle-new-password')"></i>
                    </div>

                    <div class="input-icon-container">
                        <input id="confirm-password" type="password" placeholder="تأكيد كلمة المرور الجديدة"
                        name="password_confirmation"/>
                        <i class="far fa-eye" id="toggle-confirm-password"
                            onclick="togglePassword('confirm-password', 'toggle-confirm-password')"></i>
                    </div>

                    <button type="submit">تأكيد</button>
                </form>
            </section>
            <section id="change-language" class="reset-password-container hidden">
                <img src="{{ asset('front/assets/img/logo.svg') }}"/>
                <form class="reset-password-form" method="POST" action="{{route('dashboard/update/profile')}}">
                    @csrf
                    <label>تعين اللغه الافتراضيه</label>
                    <div class="input-icon-container">
                        <select class="form-control" name="lang" id="language">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <option value="{{ $localeCode }}" {{ app()->getLocale() == $localeCode ? 'selected' : '' }}>{{ $properties['native'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit">تأكيد</button>
                </form>
            </section>
            <section id="subscription" class="subscription-container hidden">
                <div class="container">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="card pricing-card d-block">
                                <div class="card-body  d-block">
                                    <h5 class="card-title">أساسي</h5>
                                    <p class="price">$140 شهرياً</p>
                                    <p class="description">استشارة واحدة كل 3 أيام</p>
                                    <p class="description">Organize your notes and workflows.</p>
                                    <p class="description">5GB of space.</p>
                                    <button class="btn">اختيار الخطة</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card pricing-card featured d-block">
                                <div class="card-body d-block">
                                    <h5 class="card-title">أساسي</h5>
                                    <p class="price">$140 شهرياً</p>
                                    <p class="description">استشارة واحدة كل 3 أيام</p>
                                    <p class="description">Organize your notes and workflows.</p>
                                    <p class="description">5GB of space.</p>
                                    <button class="btn">اختيار الخطة</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card pricing-card ">
                                <div class="card-body d-block">
                                    <h5 class="card-title">أساسي</h5>
                                    <p class="price">$140 شهرياً</p>
                                    <p class="description">استشارة واحدة كل 3 أيام</p>
                                    <p class="description">Organize your notes and workflows.</p>
                                    <p class="description">5GB of space.</p>
                                    <button class="btn">اختيار الخطة</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <h5 class="text-primary">أساسي</h5>
                            <p>استشارة واحدة كل 3 أيام</p>
                            <p>ستتاح لك الطلبات الجديدة الواردة من العملاء المحتملين فقط بعد مرور 72 ساعة. هذا
                                يعني أن من الممكن أن يكون قد تم أخذ تلك الاستشارات من قبل المحامين المشتركين
                                الآخرين (الذين يمتلكون حساباً مدفوعاً)، وهذا قد لا تكون مناسبة لك. لن يطبق هذا
                                التأخير على الاستشارات الموجهة إليك مباشرة (على سبيل المثال، عندما تكون متاحاً
                                الآن وعميل يريد التحدث معك).</p>
                            <p>طلب تواصل عبر بوابتنا</p>
                            <p>يمكنك أيضاً طلب تواصل فقط برسوم أعلى (سواء عبر طريق سؤال عام، محادثة خاصة، أو طلب
                                معاودة اتصال) كل 24 ساعة. لا ينطبق هذا القيد على الطلبات الموجهة إليك مباشرة
                                (على سبيل المثال، عندما تكون متاحاً الآن وعميل يريد التحدث معك).</p>
                            <p>يمكنك نشر مقال واحد في قسم المدونة القانونية كل 30 يوماً.</p>
                            <button class="btn btn-primary">اختيار الخطة</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

<!-- custom js -->
@section('script')
    <script>
        function togglePassword(inputId, toggleIconId) {
            const inputField = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleIconId);

            if (inputField.type === "password") {
                inputField.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                inputField.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('sidebar-change-language').addEventListener('click', function() {
                document.getElementById('change-language').classList.remove('hidden');
                document.getElementById('reset-password').classList.add('hidden');
                document.getElementById('user-profile').classList.add('hidden');
                document.getElementById('subscription').classList.add('hidden');
            });
            document.getElementById('sidebar-reset-password').addEventListener('click', function() {
                document.getElementById('reset-password').classList.remove('hidden');
                document.getElementById('change-language').classList.add('hidden');
                document.getElementById('user-profile').classList.add('hidden');
                document.getElementById('subscription').classList.add('hidden');
            });
            document.getElementById('sidebar-user-profile').addEventListener('click', function() {
                document.getElementById('user-profile').classList.remove('hidden');
                document.getElementById('change-language').classList.add('hidden');
                document.getElementById('reset-password').classList.add('hidden');
                document.getElementById('subscription').classList.add('hidden');
            });
            document.getElementById('sidebar-subscription').addEventListener('click', function() {
                document.getElementById('subscription').classList.remove('hidden');
                document.getElementById('change-language').classList.add('hidden');
                document.getElementById('reset-password').classList.add('hidden');
                document.getElementById('user-profile').classList.add('hidden');
            });
        });
    </script>
    <script>
        $('#languages').select2({
            ajax: {
                url: "{{ route('get/languages') }}",
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
    </script>
@endsection
