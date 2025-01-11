@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Settings</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Settings</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/settings/index')}}/0/{{PAGINATION_COUNT}}">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Index</li>
                </ol>
            </nav>
            </div>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Settings Viwes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
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
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6 text-right">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                <!-- <label><input placeholder="search" type="search" class="form-control input-sm data_search" aria-controls="dataTables-example"></label> -->
                            </div>
                        </div>
                    </div>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            
                            @isset($setting)
                                <form role="form" action="{{url(route('admin/settings/update', $setting->id))}}" method="post" enctype="multipart/form-data">
                                    <div class="tab-content">
                                        @csrf
                                        

                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">mobile <span style="color: red;">*</span></span>
                                            <input name="mobile" type="text" class="form-control" placeholder="mobile" value="{{$setting->mobile}}">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">email <span style="color: red;">*</span></span>
                                            <input name="email" type="email" class="form-control" placeholder="email" value="{{$setting->email}}">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">location <span style="color: red;"></span></span>
                                            <input name="location" type="text" class="form-control" placeholder="location" value="{{$setting->location}}">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">facebook</span>
                                            <input name="facebook" type="text" class="form-control" placeholder="facebook" value="{{$setting->facebook}}">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">whats</span>
                                            <input name="whats" type="text" class="form-control" placeholder="whats" value="{{$setting->whats}}">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">insta</span>
                                            <input name="insta" type="text" class="form-control" placeholder="insta" value="{{$setting->insta}}">
                                        </div>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">app url</span>
                                            <input name="app_url" type="text" class="form-control" placeholder="app_url" value="{{$setting->app_url}}">
                                        </div>                            
                                        <div class="form-group input-group">
                                            <span class="input-group-addon" style="color: black;">Upload Logo</span>
                                            <input name="website_logo" type="file" class="form-control" placeholder="Upload Logo">
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit Button</button>
                                    </div>
                                </form>
                            @endisset
                        </table>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>

@endsection

<!-- custom js -->
@section('script')
@endsection
