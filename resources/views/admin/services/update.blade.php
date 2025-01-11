@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Services</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Service Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/services/index')}}/0/{{PAGINATION_COUNT}}">Services</a></li>
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
                    <div class="panel-title pull-left">Services Form</div>
                </div>
                <div class="panel-body">
                    @isset($service)
                        <form role="form" action="{{url(route('admin/services/update', $service->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">name ar <span style="color: red;">*</span></span>
                                    <input name="name_ar" type="text" class="form-control" placeholder="name ar" value="{{$service->translate('ar')?->name}}"> 
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">name en <span style="color: red;">*</span></span>
                                    <input name="name_en" type="text" class="form-control" placeholder="name en" value="{{$service->translate('en')?->name}}">
                                </div>
                                <!-- <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <select class="form-control" name="icon" id="icons">
                                        <option value="">icons</option>
                                        <option value="icons 1" {{$service->icon == 'icons 1' ? 'selected' : ''}}>icons 1</option>
                                        <option value="icons 2" {{$service->icon == 'icons 2' ? 'selected' : ''}}>icons 2</option>
                                        <option value="icons 3" {{$service->icon == 'icons 3' ? 'selected' : ''}}>icons 3</option>
                                    </select>
                                </div> -->
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <input name="logo" type="file" class="form-control" placeholder="Upload Logo">
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
