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
            {{-- <h1 class="page-header">Add New About</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/abouts/index')}}/0/{{PAGINATION_COUNT}}">Abouts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
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
                    <form role="form" action="{{url(route('admin/abouts/create'))}}" method="post" enctype="multipart/form-data">
                        <div class="tab-content">
                            @csrf
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">Content AR <span style="color: red;">*</span></span>
                                <textarea class="form-control ckeditor content" name="content_ar" placeholder="Content AR"></textarea>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">Content EN <span style="color: red;">*</span></span>
                                <textarea class="form-control ckeditor content" name="content_en" placeholder="Content EN"></textarea>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">Upload Image</span>
                                <input name="photo" type="file" class="form-control" placeholder="">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;"></span>
                                <select class="form-control" name="img_dir">
                                    <option value="">اتجاه الصوره</option>
                                    <option value="1">يمين</option>
                                    <option value="2">شمال</option>
                                </select>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;"></span>
                                <select class="form-control" name="about_type">
                                    <option value="">عن الشركة</option>
                                    <option value="1">عن الشركة في الرئيسيه</option>
                                    <option value="2">اسال محامي  في الرئيسيه</option>
                                    <option value="3">لماذا يختارنا العملاء ؟</option>
                                    <option value="4">سير العملية للوكلاء</option>
                                    <option value="5">سياسة الخصوصية</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Submit Button</button>
                            <button type="reset" class="btn btn-primary">Reset Button</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- custom js -->
@section('script')
@endsection
