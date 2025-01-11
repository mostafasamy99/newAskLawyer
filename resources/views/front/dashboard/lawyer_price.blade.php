@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        .notification-badge {
            position: absolute;
            top: -1px;
            right: -10px;
            background: red;
            color: white;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 12px;
            line-height: 1;
        }
        .dropdown-menu {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .dropdown-item {
            font-size: 1rem;
        }
        .dropdown-item:hover {
            background-color: rgba(209, 176, 107, 0.8);
        }
        .notification i {
            font-size: 1.6rem;
            color: rgba(209, 176, 107, 1);
        }
        .blog-card {
            padding: 15px 10px;
            margin: 15px 10px;
        }
        .card-custom .card-title {
            font-size: 1.1rem;
            font-weight: bold;
            margin: 10px 0px;
        }
        .blog-card .card-subtitle {
            font-size: 1rem;
            color: gray;
        }
        .blog-card .card-text {
            text-align: justify;
            margin-top: 20px;
            font-size: 20px;
            color: rgb(102, 108, 137);
            font-weight: 500;
            max-width: 900px;
        }
        .faq-item {
            margin-bottom: 20px;
        }
        .form-section {
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }
        .form-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-row label {
            font-weight: bold;
            margin: 10px 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
        }
        .form-row input {
            background-color: rgb(245, 245, 245);
            border: 1px solid rgb(245, 245, 245);
            padding: 8px 6px;
            border-radius: 10px;
            width: 250px;
            margin-bottom: 15px;
        }
        .card-title {
            margin-bottom: 20px;
        }
        .card-text {
            margin-bottom: 30px;
        }
        .form-section .btn {
            background-color: rgb(0, 45, 98);
            border: none;
            color: rgb(255, 255, 255);
            padding: 14px 50px;
            text-align: center;
            font-size: 18px;
            cursor: pointer;
            border-radius: 8px;
            font-weight: 600;
        }
        .BlogPrice {
            color: #e2ac6c;
            font-weight: 600;

            font-size: 2rem;
            text-align: center;
        }
        .card {
            margin: 20px 0;
        }
    </style>
@endsection

@section('content')
    <div class="row position-relative">
        <div class="col-lg-12">
            <div class="container">
                <div class="faq-item">
                    @isset($data['blogs'])

                        <div class="main-content">
                            <div class="card blog-card">
                                <div>
                                    <h1 class="card-title">{{ $data['blogs']['title'] ?? $data['blogs']['translations'][0]['title'] }}</h1>
                                    <p class="card-text">{!! $data['blogs']['content'] ?? $data['blogs']['translations'][0]['content'] !!}</p>
                                </div>

                                <div class="card" style="width: 20rem;">
                                    <div class="blog-card">
                                        <h5 class="card-title">محتوى المدونة </h5>
                                        <p class="card-text">{{ $data['blogs']['description'] ?? $data['blogs']['translations'][0]['description'] }}</p>
                                    </div>
                                </div>
                                <h2 class="BlogPrice">{{ $data['blogs']['price'] }} $</h2>


                                <!-- Input for Price and Labels in Inline Rows -->
                                <form dir="ltr" class="form-section" action="{{route('dashboard/blogs/cost/update', $data['blogs']['id'])}}">

                                    @csrf
                                    <div class="form-row">
                                        <label for="countries">Countries: {{ $data['blogs']['country']['name'] ?? 'country' }}</label>
                                    </div>

                                    <div class="form-row">
                                        <label for="services">Services: {{ $data['blogs']['service']['name'] ?? 'service' }}</label>
                                    </div>

                                    <div class="form-row">
                                        <label for="subjects">Subjects: {{ $data['blogs']['subject']['name'] ?? 'subject' }}</label>
                                    </div>

                                    <div class="form-row">
                                        <label for="sections">Sections: {{ $data['blogs']['section']['name'] ?? 'section' }}</label>
                                    </div>

                                    <div class="form-row">
                                        <label for="price">Price:</label>
                                        <input id="price" name="price" placeholder="Enter price">
                                    </div>

                                    <button type="submit" class="btn btn-primary">submit</button>
                                </form>
                            </div>
                        </div>

                    @endisset

                    <div class="faq-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- custom js -->
@section('script')
@endsection
