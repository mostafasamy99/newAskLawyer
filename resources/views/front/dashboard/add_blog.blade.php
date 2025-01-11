@extends('layouts.front.dashboard.home')

<!-- title page -->
@section('title')
@endsection

<!-- custom page -->
@section('css')
    <style>
        .form-container-wrapper {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form-container {
            flex: 1;
            margin: 0 10px;
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            color: rgb(226, 172, 108);

        }

        .first-button {
            background-color: #002e5b;
            color: #fff;
            border-radius: 10px;
        }

        .second-button {
            background-color: #e2ac6c;
            color: #fff;
            border-radius: 10px;
        }

        .form-control {
            background-color: rgb(245, 245, 245);
            border: 1px solid rgb(245, 245, 245);
            padding: 15px 10px;
            border-radius: 10px;
            width: 100%;
            margin-bottom: 15px;
        }
        .content-title{
            font-size: 19px;
            font-weight: 400;
        }
        .select2-container--default .select2-selection--single{
            background-color: rgb(245, 245, 245);
            border: 1px solid rgb(245, 245, 245);
            padding: 4px ;
            border-radius: 10px;
            width: 100%;
            height: 40px;
            margin-bottom: 15px;
        }
 
    </style>
@endsection

@section('content')

    <div class="row position-relative" style="margin-top: 40px;">

        <div class="col-lg-12">
            <div class="container">
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
                <div class="mb-3">
                    <button class="btn btn-primary" onclick="showForm('arForm')">AR</button>
                    <button class="btn btn-secondary" onclick="showForm('enForm')">EN</button>
                </div>
                <form action="{{url(route('dashboard/blogs/store'))}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div id="arForm" class="form-container active" dir="rtl">
                        <div id="formAr">
                            <div class="mb-3">
                                <input name="title_ar" type="text" class="form-control" id="titleAr" placeholder="العنوان AR">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="description_ar" id="descriptionAr" rows="3" placeholder="الوصف AR"></textarea>
                            </div>
                            <div class="form-group">
                                <label class=" mb-3 content-title"> المحتوى AR </label>
                                <textarea class="form-control ckeditor content" name="content_ar" placeholder="Content AR"></textarea>
                            </div>
                            <div class="mb-3 mt-3">
                                <input name="photo" type="file" class="form-control" id="fileAr">
                            </div>
                            <div class="mb-3">
                                <select class="form-control mb-2" name="country_id" id="countries">
                                    <option value="">countries</option>
                                </select>
                                <select class="form-control mb-2" name="service_id" id="services">
                                    <option value="">services</option>
                                </select>
                                <select class="form-control mb-2" name="subject_id" id="subjects">
                                    <option value="">subjects</option>
                                </select>
                                <select class="form-control mb-2" name="section_id" id="sections">
                                    <option value="">sections</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input name="price" type="number" class="form-control" id="priceAr" placeholder="السعر">
                            </div>
                            {{-- <div class="mb-3">
                                <input name="order" type="number" class="form-control" id="orderAr" placeholder="طلب">
                            </div> --}}
                            <div dir="rtl" class="form-check form-check-reverse">
                                <label class="form-check-label" for="reverseCheck1">
                                    is favourite 
                                </label>
                                <input name="is_favorite" class="form-check-input" type="checkbox" value="1" id="reverseCheck1">
                            </div>
                        </div>
                    </div>
                    <div id="enForm" class="form-container">
                        <div id="formEn">
                            <div class="mb-3">
                                <input name="title_en" type="text" class="form-control" id="titleAr" placeholder="العنوان EN">
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" name="description_en" id="descriptionAr" rows="3" placeholder="الوصف EN"></textarea>
                            </div>
                            <div class="form-group">
                                <label class=" mb-3 content-title"> المحتوى En </label>
                                <textarea class="form-control ckeditor content" name="content_en" placeholder="Content EN"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn first-button btn-lg">Submit</button>
                    <button type="reset" class="btn btn-lg second-button">Reset </button>
                </form>
            </div>
        </div>
    </div>
@endsection

<!-- custom js -->
@section('script')
    <script>
        function showForm(formId) {
            document.querySelectorAll('.form-container').forEach(form => form.classList.remove('active'));
            document.getElementById(formId).classList.add('active');
        }
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
