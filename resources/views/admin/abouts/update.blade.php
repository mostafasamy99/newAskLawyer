@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Abouts</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">About Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/abouts/index')}}/0/{{PAGINATION_COUNT}}">Abouts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            </div>
        </div>
    </div>
    <!-- row -->
    <div class="row">
        <div class="col-lg-12">
            @include('flash::message')
            <div class="panel tabbed-panel panel-info">
                @if ($errors->any())
                    <div style="text-align: left; margin: 15px;">
                        <ul dir="ltr">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel-heading clearfix">
                    <div class="panel-title pull-left">Abouts Form</div>
                </div>
                <div class="panel-body">
                    @isset($about)
                        <form role="form" action="{{url(route('admin/abouts/update', $about->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Content AR<span style="color: red;">*</span></span>
                                    <textarea class="form-control ckeditor content" name="content_ar" placeholder="Content">{!! $about->translate('ar')?->content !!}</textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Content EN<span style="color: red;">*</span></span>
                                    <textarea class="form-control ckeditor content" name="content_en" placeholder="Content">{!! $about->translate('en')?->content !!}</textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Upload Image</span>
                                    <input name="photo" type="file" class="form-control" placeholder="">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <select class="form-control" name="img_dir">
                                        <option value="">اتجاه الصوره</option>
                                        <option value="1" {{ $about->img_dir == 1 ? 'selected' : '' }}>يمين</option>
                                        <option value="2" {{ $about->img_dir == 2 ? 'selected' : '' }}>شمال</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <select class="form-control" name="about_type">
                                        <option value="">عن الشركة</option>
                                        <option value="1" {{ $about->about_type == 1 ? 'selected' : '' }}>الرئيسيه</option>
                                        <option value="2" {{ $about->about_type == 2 ? 'selected' : '' }}>اسال محامي</option>
                                        <option value="3" {{ $about->about_type == 3 ? 'selected' : '' }}>لماذا يختارنا العملاء ؟</option>
                                        <option value="4" {{ $about->about_type == 4 ? 'selected' : '' }}>سير العملية للوكلاء</option>
                                        <option value="5" {{ $about->about_type == 5 ? 'selected' : '' }}>سياسة الخصوصية</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Submit Button</button>
                            </div>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- custom js -->
@section('script')
@endsection
