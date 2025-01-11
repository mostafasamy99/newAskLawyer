@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Blogs</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Blog Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/blogs/index')}}/0/{{PAGINATION_COUNT}}">Blogs</a></li>
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
                    <div class="panel-title pull-left">Blogs Form</div>
                    <div class="pull-right">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#section_ar" data-toggle="tab">AR</a></li>
                            <li><a href="#section_en" data-toggle="tab">EN</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    @isset($blog)
                        <form role="form" action="{{url(route('admin/blogs/update', $blog->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                <div class="tab-pane fade in active" id="section_ar">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">title ar <span style="color: red;"></span></span>
                                        <input name="title_ar" value="{{$blog->translate('ar')?->title}}" type="text" class="form-control" placeholder="title">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">description ar <span style="color: red;"></span></span>
                                        <input name="description_ar" value="{{$blog->translate('ar')?->description}}" type="text" class="form-control" placeholder="description">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">Content <span style="color: red;"></span></span>
                                        <textarea class="form-control ckeditor content" name="content_ar" placeholder="Content">{!! $blog->translate('ar')?->content !!}</textarea>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">Upload Image <span style="color: red;"></span></span>
                                        <input name="photo" type="file" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">countries <span style="color: red;">*</span></span>
                                        <select class="form-control" name="country_id" id="countries">
                                            <option value="{{$blog->country_id}}">{{$blog->country?->name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">services <span style="color: red;">*</span></span>
                                        <select class="form-control" name="service_id" id="services">
                                            <option value="{{$blog->service_id}}">{{$blog->service?->name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">subjects <span style="color: red;">*</span></span>
                                        <select class="form-control" name="subject_id" id="subjects">
                                            <option value="{{$blog->subject_id}}">{{$blog->subject?->name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">sections <span style="color: red;">*</span></span>
                                        <select class="form-control" name="section_id" id="sections">
                                            <option value="{{$blog->section_id}}">{{$blog->section?->name}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">price</span>
                                        <input name="price" type="number" class="form-control" placeholder="price" value="{{$blog->price}}">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">order</span>
                                        <input name="order" type="number" class="form-control" placeholder="order" value="{{$blog->order}}">
                                    </div>
                                    <div class="form-check form-switch" style="margin-bottom: 10px;">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefaultFixed" name="is_fixed_service" value="1" value="1" {{ $blog->is_fixed_service == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexSwitchCheckDefaultFixed">Is Fixed Service</label>
                                    </div>
                                    <div class="form-group input-group" style="margin-bottom: 10px;">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="is_favorite" value="1" {{ $blog->is_favorite == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Is Favorite</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade in" id="section_en">
                                    <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">title en <span style="color: red;"></span></span>
                                        <input name="title_en" value="{{$blog->translate('en')?->title}}" type="text" class="form-control" placeholder="title">
                                    </div>
                                    <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">description en <span style="color: red;"></span></span>
                                        <input name="description_en" value="{{$blog->translate('en')?->description}}" type="text" class="form-control" placeholder="description">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon" style="color: black;">Content <span style="color: red;"></span></span>
                                        <textarea class="form-control ckeditor content" name="content_en" placeholder="Content">{!! $blog->translate('en')?->content !!}</textarea>
                                    </div>
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
    $('#services').select2({
        ajax: {
            url: "{{ route('get/services') }}",
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
    $('#subjects').select2({
        ajax: {
            url: "{{ route('get/subjects') }}",
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
    $('#sections').select2({
        ajax: {
            url: "{{ route('get/sections') }}",
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
@endsection

