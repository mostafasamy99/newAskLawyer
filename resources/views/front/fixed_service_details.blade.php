@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>طلب عرض أسعار </h1>
    </section>

    <section class="lawyer-details">
        <div class="container mt-5">
            <div class="row">

                @isset($data['blog'])
                    <div class="col-md-9">
                        <div class="main-content">
                            <div class="lawyer-details">
                                <div class="profile-header">

                                    @php
                                        $lawyerPrice = collect($data['blog']['prices'])->firstWhere('lawyer_id', $lawyer_id) ?? null;
                                        if ($lawyerPrice) {
                                            $lawyerPrice = (array) $lawyerPrice;
                                        }
                                    @endphp

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <img src="{{ asset($data['blog']['img'] ?? 'front/assets/img/shak-hand.jpg') }}" alt="Lawyer Image" class="img-fluid" width="100">
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="lawyer-card card">
                                                <div class="card-body">
                                                    <div class="card-meta">
                                                        <h5>{!! $data['blog']['title'] ?? $data['blog']['translations'][0]['title'] !!}</h5>
                                                    </div>
                                                    <hr>
                                                    <p class="process-description">{!! $data['blog']['description'] ?? $data['blog']['translations'][0]['description'] !!}</p>
                                                    <div class="deposit-section">
                                                        <div>
                                                            <h3 class="mb-1">مبلغ الايداع المطلوب</h3>
                                                            <p class="amount">USD {{ $lawyerPrice['price'] ??  $data['blog']['price']}}</p>
                                                        </div>
                                                        <a href="{{ route('front/services', [8, $lawyerPrice['lawyer_id'] ?? 0, $data['blog']['id']]) }}" class="btn btn-request">اطلب</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lawyer-bio">
                                <h5>وصف الخدمة</h5>
                                <p class="process-description">{!! $data['blog']['content'] ?? $data['blog']['translations'][0]['content'] !!}</p>
                                {{-- <button class="btn btn-request float-left">اطلب</button> --}}
                            </div>
                            <div class="lawyer-bio mt-4">
                                <h5>كيفية سير العملية</h5>
                                <p class="process-description">يمكنك إرسال طلب للحصول على عروض أسعار (RFQ) عبر موقع ليجال أدفيس ميدل إيست إلى المحامين المشاركين والحصول على عروض أسعار منهم للاختيار من بينها. يمكنك بعد ذلك قبول أي عرض تلقيته وتوظيف المحامي الذين اخترته عن طريق دفع أتعابه عبر الإنترنت. ستحتاج إلى دفع مبلغ صغير قابل للاسترداد لإثبات جدية طلبك قبل إرسال طلب عرض الأسعار الخاص بك إلى المحامين. يمكنك لاحقًا استخدام هذا المبلغ لدفع أتعاب المحامي، أو طلب استرداده إذا حصلت لأي سبب من الأسباب على أقل من ثلاثة عروض أسعار من المحامين خلال المهلة المحددة (خمسة أيام عمل).</p>
                            </div>
                            <div class="card review-card mt-3">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>قراءات ذات صلة </h5>
                                    <a href="#">رؤية الكل</a>
                                </div>
                                <div class="card-body">
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                    <hr>
                                    <p>لوريم إيبسوم دولار سيت أميت, كونسيكتيتور أدايبا يسكينج أليايت, سيت دو أيوسمود تيمبور.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset

                <div class="col-md-3 sidebar">
                    <div class="h-100">
                        <div class="position-sticky sticky-top">

                            <div class="lawyer-list">
                                <h5>شراء خدمة من</h5>
                                @foreach ($data['blog']['prices'] as $lawyer)
                                    @if ($lawyer['lawyer']['id'] != $lawyer_id)
                                        <a href="{{ route('front/services', [8, $lawyer['lawyer']['id'], $data['blog']['id']])}}" class="lawyer-item">
                                            <img src="{{asset($lawyer['lawyer']['img'])}}" alt="Lawyer Image">
                                            <div class="content">
                                                <p class="title">{{ $lawyer['lawyer']['name'] }}</p>
                                                <p class="sub-title">
                                                    USD {{ $lawyer['price'] }}
                                                </p>
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
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
@endsection
