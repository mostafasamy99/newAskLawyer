@extends('layouts.front.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
@endsection

@section('content')

    <section class="page-title">
        <h1>سياسة الخصوصية </h1>
    </section>

    @isset($data['privacy_policy'])
        <section class="process-section">
            <div class="container-fluid custom-container">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{asset('front/assets/img/about.jpg')}}" alt="Process Image">
                    </div>
                    <div class="col-md-8 process-content">
                        <!-- <h2 class="process-title">سياسة الخصوصية</h2> -->
                        <p class="process-description">{!! $data['privacy_policy']['content'] !!}</p>
                    </div>
                </div>
            </div>
        </section>
    @endisset

@endsection

<!-- custom js -->
@section('scriptAddClass')
    <script>
        $('#privacy').addClass('active');
    </script>
@endsection
@section('script')
@endsection