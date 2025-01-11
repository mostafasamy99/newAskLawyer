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
            {{-- <h1 class="page-header">Add New Lawyer</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/lawyers/index')}}/0/{{PAGINATION_COUNT}}">Lawyers</a></li>
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
                    <div class="panel-title pull-left">Lawyers Form</div>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{url(route('admin/lawyers/create'))}}" method="post" enctype="multipart/form-data">
                        <div class="tab-content">
                            @csrf
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="name" type="text" class="form-control" placeholder="name">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="title" type="text" class="form-control" placeholder="title">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="email" type="text" class="form-control" placeholder="email">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="mobile" type="text" class="form-control" placeholder="mobile">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;"></span>
                                <input name="address" type="text" class="form-control" placeholder="address">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;"></span>
                                <input name="linked_in" type="text" class="form-control" placeholder="linked in">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <select class="form-control" name="type">
                                    <option value="">النوع</option>
                                    <option value="1">محامي</option>
                                    <option value="2">شركه</option>
                                </select>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <select class="form-control" name="country_id" id="countries">
                                    <option value="">countries</option>
                                </select>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <select class="form-control" name="city_id" id="cities">
                                    <option value="">cities</option>
                                </select>
                            </div>
                            <!-- <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <select class="form-control" name="lang_id" id="language">
                                    <option value="">language</option>
                                </select>
                            </div> -->
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">languages <span style="color: red;">*</span></span>
                                <select class="form-control" name="languages[]" id="languages" multiple></select>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">services <span style="color: red;">*</span></span>
                                <select class="form-control" name="services[]" id="services" multiple></select>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">Legal Fields <span style="color: red;">*</span></span>
                                <select class="form-control" name="legal_fields[]" id="legal_fields" multiple></select>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">Upload Image</span>
                                <input name="photo" type="file" class="form-control" placeholder="">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">Upload Union Card</span>
                                <input name="photo_union_card" type="file" class="form-control" placeholder="Upload Image">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: black;">File <span style="color: red;">*</span></span>
                                <textarea class="form-control ckeditor file" name="file" placeholder="File"></textarea>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon" style="color: red;">*</span>
                                <input name="password_confirmation" type="password" class="form-control" placeholder="Password Confirmation">
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
    $('#cities').select2({
        ajax: {
            url: "{{ route('get/country/cities') }}",
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.term,
                    country: $('#countries').val()
                };
            },
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
    $('#languages').select2({
        ajax: {
            url: "{{ route('get/languages') }}",
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
    $('#legal_fields').select2({
        ajax: {
            url: "{{ route('get/legal_fields') }}",
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
</script>
@endsection
