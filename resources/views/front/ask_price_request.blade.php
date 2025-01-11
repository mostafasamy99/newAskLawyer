@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        .accordion-button::after {
            margin-right: auto !important;
            margin-left: 0px;
            color: rgb(226, 172, 108) !important;
        }
        .accordion-button:focus {
            box-shadow: rgb(226, 172, 108);
        }
        .accordion-button:focus {
            z-index: 3;
            border-color: rgb(226, 172, 108) !important;
            outline: 0;
            box-shadow: rgb(212, 212, 212) !important;
        }
        .accordion-button:not(.collapsed) {
            color: rgb(226, 172, 108);
            background-color: #052440 !important;
        }
        .accordion-button {
            color: rgb(226, 172, 108) !important;
        }
        .textDote li{
            list-style: circle;
        }
        .accordion-item .accordion-item-area {
            padding: 10px;
            font-size: 11px;
        }
        .accordion-item ul {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single {
            border: none;
            width: 100%;
            border-radius: 10px;
            height: 40px;
            background-color: rgba(235, 238, 242, 0.8);
            display: flex;
            align-items: center;
        }
        .select2-container {
            width: 100% !important;
            direction: rtl;

        }
        /* .select2-container .select2-selection--single .select2-selection__rendered {
            background-color: rgba(235, 238, 242, 0.8) !important;

        } */
        .select2-container--default .select2-selection--single .select2-selection__rendered{
            padding-right: 15px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow{
            left: 1px;
            right: unset;
            top: 0;
            height: 100%;
        }

    </style>
@endsection

@section('content')
    {{ csrf_field() }}
    <section class="page-title">
        <h1> {{$data['service']['name'] ?? 'الطلب'}} </h1>
    </section>

    <div dir="ltr" class="container" style="margin-top: 25px;">
        @include('flash::message')
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger" style="font-color: white;">{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <section class="lawyers-area lawyer-details">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-9 main-content">
                    <div class="container steps-hirinig">
                        <!-- Steps Progress Bar -->
                        <div class="steps-progress">
                            <ul id="progressbar">
                                <li class="step active" data-step="1">الشروط</li>
                                <li class="step" data-step="2">بيانات التواصل</li>
                                <li class="step" data-step="3">ملخص {{$data['service']['name'] ?? 'الطلب'}}</li>
                            </ul>
                        </div>

                        <!-- Steps Content -->
                        <div class="steps-content">
                            <form action="{{route('request/paid-services', encrypt($data['service']['id'] ?? 0))}}" method="POST" class="form-steps-content" enctype="multipart/form-data">
                                @csrf

                                <div class="step-content active" data-step="1">
                                    <h3>الشروط والاحكام</h3>
                                    <p>
                                        وصف الخدمة
                                        ستساعدك هذه الخدمة في العثور على المحامي المناسب بسرعة وسهولة من خلال السماح لك بالحصول
                                        على عروض أسعار من المحامين في شبكتنا. ما عليك سوى وصف احتياجاتك القانونية، وإرسال طلبك،
                                        والبدء في الحصول على عروض من المحامين المهتمين بتقديم الخدمة التي طلبتها لك.

                                        نحن نضمن لك أنك ستتلقى ما لا يقل عن 3 عروض من محامين مختلفين خلال خمسة أيام عمل. في
                                        الغالب، ستتلقى عرض الأسعار الأول في غضون يوم عمل أو يومين، ولكن إذا لم يكن طلبك معقدًا
                                        بشكل مبالغ، فيمكنك توقع الاستلام في نفس اليوم.

                                        هام: كما تعلم، فإن المحامين مشغولون ووقتهم ثمين. سيحتاجون إلى قضاء بعض الوقت في دراسة
                                        قضيتك لتقديم عرض أسعار لك. لهذا السبب سيُطلب منك إيداع مبلغ قليل (49 دولارًا أمريكيًا)
                                        قابل للاسترداد لإثبات جدية طلبك. يمكنك فيما بعد استخدام مبلغ الإيداع هذا لدفع أتعاب
                                        المحامي الذي تختاره لتوظيفه. إذا لم تحصل لبعض الأسباب على ثلاثة عروض على الأقل من
                                        المحامين في غضون خمسة أيام عمل، فسنقوم برد مبلغ الإيداع.

                                        هذه الخدمة مناسبةً لك إذا كانت لديك مشكلة قانونية معقدة أو بعض المتطلبات الخاصة، وترغب
                                        في مقارنة خبرة وسعر وتخصص المحامين المتوفرين لضمان توظيفك للمحامي المناسب لاحتياجاتك
                                        القانونية.

                                        إليك كيفية البدء:

                                        أرسل طلب الحصول على عرض أسعار الخاص بك
                                        استلم عروضًا من عدة محامين
                                        راجع العروض وتفاوض على الشروط إن احتجت إلى هذا
                                        اختر المحامي الأفضل والأنسب للمهمة
                                        ادفع الدفعة المقدمة المتفق عليها لقبول العرض وتوظيف المحامي

                                    </p>

                                    <div>
                                        <h3> كيفية سير العملية</h3>
                                        <P>
                                            يمكنك إرسال طلب للحصول على عروض أسعار (RFQ) عبر موقع ليجال أدفيس ميدل إيست إلى
                                            المحامين المشاركين والحصول على عروض أسعار منهم للاختيار من بينها. يمكنك بعد ذلك قبول
                                            أي عرض تلقيته وتوظيف المحامي الذين اخترته عن طريق دفع أتعابه عبر الإنترنت.

                                            ستحتاج إلى دفع مبلغ صغير قابل للاسترداد لإثبات جدية طلبك قبل إرسال طلب عرض الأسعار
                                            الخاص بك إلى المحامين. يمكنك لاحقًا استخدام هذا المبلغ لدفع أتعاب المحامي، أو طلب
                                            استرداده إذا حصلت لأي سبب من الأسباب على أقل من ثلاثة عروض أسعار من المحامين خلال
                                            المهلة المحددة (خمسة أيام عمل).
                                        </p>
                                        <div class="accordion" id="accordionExample">

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        كيف توظف محامي؟
                                                    </button>
                                                </h2>
                                                <div class="accordion-item-area">
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                        <h6 class="pt-3">يمكنك توظيف محامي عبر الإنترنت للخدمة التي تختارها من خلال هذه الخطوات البسيطة :</h6>
                                                        <div class="accordion-body">
                                                            <ul class="textDote">
                                                                <li > <strong> قم بتأكيد موافقتك على شروط الخدمة.</strong> </li>
                                                                <p>يرجى ملاحظة أنه لن يكون هناك اتفاق ملزم بينك وبين المحامي إلا إذا قبلت عرض الأسعار الذي قدمه. ستخضع جميع اتصالاتك مع المحامين فيما يتعلق بطلب عروض الأسعار في هذه الحالة إلى شروط الخدمة التي وافقت عليها.</p>
                                                            </ul>
                                                            <ul class="textDote">
                                                                <li > <strong> تقديم المعلومات اللازمة.
                                                                </strong> </li>
                                                                <p>يرجى ملاحظة أنه لن يكون هناك اتفاق ملزم بينك وبين المحامي إلا إذا قبلت عرض الأسعار الذي قدمه. ستخضع جميع اتصالاتك مع المحامين فيما يتعلق بطلب عروض الأسعار في هذه الحالة إلى شروط الخدمة التي وافقت عليها.</p>
                                                            </ul>
                                                            <ul class="textDote">
                                                                <li > <strong> قم بتأكيد موافقتك على شروط الخدمة.</strong> </li>
                                                                <p>يرجى ملاحظة أنه لن يكون هناك اتفاق ملزم بينك وبين المحامي إلا إذا قبلت عرض الأسعار الذي قدمه. ستخضع جميع اتصالاتك مع المحامين فيما يتعلق بطلب عروض الأسعار في هذه الحالة إلى شروط الخدمة التي وافقت عليها.</p>
                                                            </ul>
                                                            <ul class="textDote">
                                                                <li > <strong> قم بتأكيد موافقتك على شروط الخدمة.</strong> </li>
                                                                <p>يرجى ملاحظة أنه لن يكون هناك اتفاق ملزم بينك وبين المحامي إلا إذا قبلت عرض الأسعار الذي قدمه. ستخضع جميع اتصالاتك مع المحامين فيما يتعلق بطلب عروض الأسعار في هذه الحالة إلى شروط الخدمة التي وافقت عليها.</p>
                                                            </ul>
                                                            <ul class="textDote">
                                                                <li > <strong> قم بتأكيد موافقتك على شروط الخدمة.</strong> </li>
                                                                <p>يرجى ملاحظة أنه لن يكون هناك اتفاق ملزم بينك وبين المحامي إلا إذا قبلت عرض الأسعار الذي قدمه. ستخضع جميع اتصالاتك مع المحامين فيما يتعلق بطلب عروض الأسعار في هذه الحالة إلى شروط الخدمة التي وافقت عليها.</p>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseOne">
                                                        ماذا بعد ذلك؟
                                                    </button>
                                                </h2>
                                                <div class="accordion-item-area">
                                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                        <h6 class="pt-3">يمكنك توظيف محامي عبر الإنترنت للخدمة التي تختارها من خلال هذه الخطوات البسيطة :</h6>

                                                        <div class="accordion-body">
                                                            <p>
                                                                بعد تسديد سعر الخدمة ورفع هويتك الشخصية، يتم تقديم طلبك للمحامي في الحال، وسوف تتلقى رسالة تأكيد إلكترونية مع معلومات التواصل مع المحامي.
                                                                وبعد تقديم الخدمة، يبلغ المحامي إدارة الموقع بإكماله للخدمة ويطلب منك التأكيد على ذلك. إذا لمتقم بتأكيد إكمال الطلب ولم تتقدم بشكوى
                                                                للموقع خلال 7 أيام، سوف تعتبر الخدمة قد قدمت بالكامل من قبل المحامي، ولن يتم قبول أية شكاوى بعد ذلك.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        لديك المزيد من الأسئلة؟
                                                    </button>
                                                </h2>
                                                <div class="accordion-item-area">
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>
                                                                لا تتردد في <a class="md-primary" ui-sref="static.contact" href="{{route('front/contact')}}">التواصل معنا  </a>
                                                                إذا كانت لديك المزيد من الاستفسارات أو كنت ترغب في تقديم اقتراحاتك وآرائك.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row mt-4">
                                        <div class="col-lg-9 align-items-center">
                                            <label class="custom-checkbox">
                                                <input type="checkbox" id="agree">
                                                <span class="checkmark"></span>
                                                أقبل شروط الخدمة
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-left">
                                            <a href="javascript:void(0);" class="button button-arrow next-step">
                                                التالي
                                                <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="arrow-icon">
                                                    <g class="arrow-head">
                                                        <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8"
                                                            stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                    <g class="arrow-body">
                                                        <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                </svg>
                                            </a>

                                        </div>
                                    </div>
                                </div>

                                <div class="step-content" data-step="2">
                                    <div class="form-container send-ques-detail">
                                        <div class="form-title text-end">بيانات التواصل</div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <input name="first_name" type="text" class="form-control" id="displayFirstName" placeholder="احمد">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="last_name" type="text" class="form-control" id="displayEmail" placeholder="علاء">
                                            </div>
                                        </div>
                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <input name="email" type="email" class="form-control" id="displayLastName" placeholder="temp@gmail.com">
                                            </div>
                                            <div class="col-md-6">
                                                <input name="mobile" type="text" class="form-control" id="displayMessage" placeholder="0100506022">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <a href="javascript:void(0);" class="button button-arrow prev-step">
                                                <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                                    <g class="arrow-head">
                                                        <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                    <g class="arrow-body">
                                                        <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                </svg>
                                                السابق
                                            </a>
                                        </div>
                                        <div class="col text-left">
                                            <a href="javascript:void(0);" class="button button-arrow next-step">
                                                التالي
                                                <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                                    <g class="arrow-head">
                                                        <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                    <g class="arrow-body">
                                                        <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="step-content" data-step="3">
                                    <div class="form-container send-ques-detail">
                                        <div class="form-title text-end">ملخص الطلب</div>
                                        <div class="form-group">
                                            <label for="fullDescription" class="text-end">المحامي</label>
                                            @if(isset($data['lawyer_or_company']) && $data['lawyer_or_company'])
                                                <input type="text" class="form-control" value="{{$data['lawyer_or_company']['name']}}" disabled>
                                                <input name="lawyer_id" type="hidden" value="{{encrypt($data['lawyer_or_company']['id'])}}">
                                            @elseif(isset($data['lawyer']) && $data['lawyer'])
                                                <input type="text" class="form-control" value="{{$data['lawyer']['name']}}" disabled>
                                                <input name="lawyer_id" type="hidden" value="{{encrypt($data['lawyer']['id'])}}">
                                            @else
                                                <select name="lawyer_id" class="form-control lawyersSeleect">
                                                    <option value="" selected>المحامي</option>
                                                </select>
                                            @endif
                                        </div>
                                        @if(isset($blog_id) && $blog_id == 0)
                                            <div class="form-group">
                                                <label for="requestSummary" class="text-end">ملخص الطلب</label>
                                                <textarea name="title" class="form-control" id="requestSummary" rows="2" placeholder="ملخص الطلب"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="fullDescription" class="text-end">الوصف كاملاً</label>
                                                <textarea name="message" class="form-control" id="fullDescription" rows="2" placeholder="الوصف كاملاً"></textarea>
                                            </div>
                                        @else
                                            <input type="hidden" name="blog_id" value="{{isset($blog_id) ? encrypt($blog_id) : '0'}}">
                                        @endif
                                        <div class="form-group mt-4">
                                            <label for="documents" class="text-end">المستندات</label>
                                            <div class="drop-zone">
                                                <label for="documents" class="drop-zone__prompt">
                                                    <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                    اسحب ملفك (ملفاتك)
                                                </label>
                                                <label for="documents" class="text-muted">
                                                    20ميجابايت بحد اقصى
                                                </label>
                                                <input name="user_files[]" type="file" id="documents" class="drop-zone__input" multiple>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <hr>
                                    <div class="row mt-4">
                                        <div class="col">
                                            <a href="javascript:void(0);" class="button button-arrow prev-step">
                                                <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                                    <g class="arrow-head">
                                                        <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                    <g class="arrow-body">
                                                        <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                                    </g>
                                                </svg>
                                                السابق
                                            </a>
                                        </div>
                                        <div class="col text-left">
                                            <button type="submit">
                                                {{-- الدفع --}}
                                                {{-- <a href="javascript:void(0);" class="button button-arrow confirm-button"> --}}
                                                    الدفع
                                                    <svg viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg" class="arrow-icon">
                                                        <g class="arrow-head">
                                                            <path d="M1 1C4.5 4 5 4.38484 5 4.5C5 4.61516 4.5 5 1 8" stroke="currentColor" stroke-width="2"></path>
                                                        </g>
                                                        <g class="arrow-body">
                                                            <path d="M3.5 4.5H0" stroke="currentColor" stroke-width="2"></path>
                                                        </g>
                                                    </svg>
                                                {{-- </a> --}}
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">
                            <div class="lawyer-list">
                                <h2 class="process-title">محام متصل </h2>
                                <div class="lawyer-item">
                                    <img src="{{ asset('front/assets/img/person.png') }}" alt="Lawyer Image">
                                    <div class="content">
                                        <p class="title">محمد احمد ابراهيم</p>
                                        <p class="sub-title">
                                            جمهورية مصر العربية
                                        </p>
                                    </div>
                                </div>
                                <div class="lawyer-item">
                                    <img src="{{ asset('front/assets/img/person.png') }}" alt="Lawyer Image">
                                    <div class="content">
                                        <p class="title">محمد احمد ابراهيم</p>
                                        <p class="sub-title">
                                            جمهورية مصر العربية
                                        </p>
                                    </div>
                                </div>
                                <div class="lawyer-item">
                                    <img src="{{ asset('front/assets/img/person.png') }}" alt="Lawyer Image">
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
        $('#get-lawyer').addClass('active');
    </script>
@endsection
@section('script')
    <script>
        var _token = $('input[name="_token"]').val();
        $('.lawyersSeleect').select2({
            ajax: {
                url: "{{ route('get/lawyers/josn') }}",
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
        $(document).ready(function () {
            $('.next-step').on('click', function () {
                if ($('input[id="agree"]:checked').length > 0) {

                    var currentStep = $(this).closest('.step-content').data('step');
                    var nextStep = currentStep + 1;

                    $('.step-content').removeClass('active');
                    $('.step-content[data-step="' + nextStep + '"]').addClass('active');
                    $('#progressbar .step').each(function() {
                        var step = $(this).data('step');
                        if (step < nextStep) {
                            $(this).removeClass('active').addClass('completed');
                        } else if (step == nextStep) {
                            $(this).removeClass('completed').addClass('active');
                        } else {
                            $(this).removeClass('active completed');
                        }
                    });
                } else {
                    $('#errorModalTerms').modal('show');
                }
            });

            $('.prev-step').on('click', function () {
                var currentStep = $(this).closest('.step-content').data('step');
                var prevStep = currentStep - 1;

                $('.step-content').removeClass('active');
                $('.step-content[data-step="' + prevStep + '"]').addClass('active');
                $('#progressbar .step').each(function() {
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
        // $(document).on('click', '.confirm-button', function () {
        //     var formData = new FormData($('.form-steps-content')[0]);
        //     $.each($('#documents')[0].files, function(i, file) {
        //         formData.append('user_files[]', file);
        //     });
        //     console.log(formData);
        //     $.ajax({
        //         url: `{{ ('request/paid-services') }}`,
        //         method: 'POST',
        //         data: formData,
        //         processData: false,
        //         contentType: false,
        //         success: function (responseData) {

        //         }
        //     })
        // });
    </script>
@endsection
