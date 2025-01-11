@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Countries</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Country Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/countries/index')}}/0/{{PAGINATION_COUNT}}">Countries</a></li>
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
                <div class="panel-heading clearfix">
                    <div class="panel-title pull-left">Countries Form</div>
                </div>
                <div class="panel-body">
                    @isset($country)
                        <form role="form" action="{{url(route('admin/countries/update', $country->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">name ar <span style="color: red;">*</span></span>
                                    <input name="name_ar" type="text" class="form-control" placeholder="name ar" value="{{$country->translate('ar')?->name}}"> 
                                    @error('name_ar')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">name en <span style="color: red;">*</span></span>
                                    <input name="name_en" type="text" class="form-control" placeholder="name en" value="{{$country->translate('en')?->name}}">
                                    @error('name_en')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
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
