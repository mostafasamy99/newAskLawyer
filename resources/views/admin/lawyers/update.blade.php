@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Lawyers</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Lawyer Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/lawyers/index')}}/0/{{PAGINATION_COUNT}}">Lawyers</a></li>
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
                    <div class="panel-title pull-left">Lawyers Form</div>
                </div>
                <div class="panel-body">
                    @isset($lawyer)
                        <form role="form" action="{{url(route('admin/lawyers/update', $lawyer->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                

                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <input name="name" value="{{$lawyer->name}}" type="text" class="form-control" placeholder="name">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <input name="title" value="{{$lawyer->title}}" type="text" class="form-control" placeholder="title">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <input name="email" value="{{$lawyer->email}}" type="text" class="form-control" placeholder="email">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <input name="mobile" value="{{$lawyer->mobile}}" type="text" class="form-control" placeholder="mobile">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <input name="address" value="{{$lawyer->address}}" type="text" class="form-control" placeholder="address">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <input name="linked_in" value="{{$lawyer->linked_in}}" type="text" class="form-control" placeholder="linked in">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <select class="form-control" name="type">
                                        <option value="">النوع</option>
                                        <option value="1" {{ $lawyer->type == 1 ? 'selected' : '' }}>محامي</option>
                                        <option value="2" {{ $lawyer->type == 2 ? 'selected' : '' }}>شركه</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <select class="form-control" name="country_id" id="countries">
                                        <option value="{{$lawyer->country_id}}">{{$lawyer->country?->name}}</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <select class="form-control" name="city_id" id="cities">
                                        <option value="{{$lawyer->city_id}}">{{$lawyer->city?->name}}</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <select class="form-control" name="lang_id" id="languages">
                                        <option value="{{$lawyer->lang_id}}">{{$lawyer->language?->name}}</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">services <span style="color: red;">*</span></span>
                                    <select class="form-control" name="services[]" id="services" multiple></select>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Upload Image</span>
                                    <input name="photo" type="file" class="form-control" placeholder="">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Upload Union Card</span>
                                    <input name="photo" type="file" class="form-control" placeholder="Upload Image">
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
