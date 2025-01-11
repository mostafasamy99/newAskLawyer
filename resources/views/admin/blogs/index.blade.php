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
            {{-- <h1 class="page-header">Blogs</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/blogs/index')}}/0/{{PAGINATION_COUNT}}">Blogs</a></li>
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
                    Blogs Viwes
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
                        {{-- <div class="col-sm-6"></div> --}}
                        <div class="col-sm-12 text-right">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                <label><input placeholder="search" type="search" class="form-control input-sm data_search" aria-controls="dataTables-example"></label>
                                <label>
                                    <div class="form-group">
                                        <select class="form-control data_search_search" name="subject_id" id="subjects" aria-controls="dataTables-example" style="width: 220px">
                                            <option value="">subjects</option>
                                        </select>
                                    </div>
                                </label>
                                <label>
                                    <div class="form-group">
                                        <select class="form-control data_search_search" name="section_id" id="sections" aria-controls="dataTables-example" style="width: 220px">
                                            <option value="">sections</option>
                                        </select>
                                    </div>
                                </label>
                                <label>
                                    <div class="form-group">
                                        <select class="form-control data_search_search" name="service_id" id="services" aria-controls="dataTables-example" style="width: 220px">
                                            <option value="">services</option>
                                        </select>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Title</th>
                                    <th class="text-center">Service</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Section</th>
                                    <th class="text-center">Subject</th>
                                    <th class="text-center">Img</th>
                                    <th class="text-center">Activation</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="tableShowData">
                                @isset($blogs)
                                    @foreach($blogs as $blog)
                                        <tr class="odd gradeX text-center">
                                            <td>{{$blog->id}}</td>
                                            <td>{{$blog->translate('ar')->title ?? $blog->translate('en')->title}}</td>
                                            <td>{{$blog->service?->name}}</td>
                                            <td>{{$blog->country?->name}}</td>
                                            <td>{{$blog->section?->name}}</td>
                                            <td>{{$blog->subject?->name}}</td>
                                            <td>
                                                <div class="ml-2 d-flex">
                                                    <img src="{{asset($blog->img)}}" alt="blog image"
                                                        class="img-fluid img-50 rounded-circle blur-up lazyloaded" width="100">
                                                </div>
                                            </td>
                                            <?php
                                                if($blog->is_activate == 1){$activate = '<span class="badge badge-info">active</span>';}
                                                else{$activate = '<span class="badge badge-danger">un active</span>';}
                                            ?>
                                            <td class="center">{!! $activate !!}</td>
                                            <td class="center">
                                                <ul class="nav navbar-center navbar-top-links" style="border-radius: 15px;">
                                                    <li class="dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                             actions <b class="caret"></b>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-user">
                                                            <li>
                                                                <a href="{{route('admin/blogs/edit', $blog->id)}}" style="text-decoration: none; color: white; width: 75px;margin:auto" class="btn btn-success">
                                                                    edit
                                                                </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li >
                                                                <button class="dropdown-item btn btn-danger openDeleteFrom" data-toggle="modal" data-target="#myModalDelete" data-id="{{$blog->id}}">
                                                                    delete
                                                                </button>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <button class="dropdown-item btn btn-priamry openActivationFrom" data-toggle="modal" data-target="#myModalActivation" data-id="{{$blog->id}}">
                                                                    activation
                                                                </button>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <button class="dropdown-item btn btn-info openActivationFrom" data-toggle="modal" data-target="#myModalSortBook" data-id="{{$blog->id}}" data-order="{{$blog->order}}">
                                                                    sort blog
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                        <div style="margin-top: 20px; font-weight: 600; font-size: 16px;">
                            Showing 1 to <span id="showItems"></span> of <span>{{App\Models\Blog::unArchive()->count()}}</span> entries
                        </div>
                        <div class="ltn__pagination-area text-center mt-5">
                            <div class="ltn__pagination text-center">
                                <div id="load_more">
                                    <button type="button" name="load_more_button" style="width: 350px;" class="btn btn-info form-control px-5" data-id="'.$last_id.'" id="load_more_button">عرض المزيد</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabell"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title f-w-600" id="exampleModalLabell">Delete Confirmation</h5>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{url(route('admin/blogs/delete'))}}" method="get">
                                        {{ csrf_field() }}
                                        <p>Are You Sure To Update This Record ?</p>
                                        <input id="delete_record_id" name="record_id" type="hidden">
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">Sure</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModalActivation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Activation Confirmation</h5>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{url(route('admin/blogs/activate'))}}" method="get">
                                        {{ csrf_field() }}
                                        <p>Are You Sure To Update This Record ?</p>
                                        <input id="activation_record_id" name="record_id" type="hidden">
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">Sure</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModalSortBook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Sort Confirmation</h5>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{url(route('admin/blogs/sort'))}}" method="get">
                                        {{ csrf_field() }}
                                        {{-- <p>Are You Sure To Update This Record ?</p> --}}
                                        <input id="sort_record_id" name="record_id" type="hidden">
                                        <label for="sort" style="width: 100%"> sort </label>
                                        <input id="sort" name="order" type="number" style="width: 100%">
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
    <script>
        $(document).on('click', '.openDeleteFrom', function() {
            var id = $(this).attr('data-id');
            $('#delete_record_id').val(id);
        });
        $(document).on('click', '.openActivationFrom', function() {
            var id = $(this).attr('data-id');
            $('#activation_record_id').val(id);
        });
        $(document).on('click', '.openActivationFrom', function() {
            var id = $(this).attr('data-id');
            var order = $(this).attr('data-order');
            $('#sort_record_id').val(id);
            console.log(order);

            $('#sort').val(order);
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
    <script>
        var _token = $('input[name="_token"]').val();
        var offset = <?php echo PAGINATION_COUNT ?>;
        var limit = <?php echo PAGINATION_COUNT ?>;
        let showItems = document.getElementById("showItems");
        showItems.innerHTML = limit
        let length = limit

        $(document).ready(function() {
            $(document).on('click', '#load_more_button', function() {
                let records = ``
                $('#load_more_button').html('<b>Loading... </b>');
                load_data(_token);

                function load_data(_token) {
                    $.ajax({
                        url: `{{ route("admin/blogs/pagination")}}/${offset}/${limit}`,
                        method: "POST",
                        data: {
                            _token: _token,
                        },
                        success: function(data) {
                            if (data.length > 0) {
                                for (let i = 0; i < data.length; i++) {

                                    image_path =  "{{ asset('') }}" + data[i].img;
                                    edit_route =  "{{ route('admin/blogs/edit') }}" + '/' + data[i].id;
                                    records += `
                                        <tr class="odd gradeX text-center">
                                            <td>${data[i].id}</td>
                                            <td>${data[i].title ?? data[i].translations[0].title}</td>
                                            <td>${data[i].service?.name}</td>
                                            <td>${data[i].country?.name}</td>
                                            <td>${data[i].section?.name}</td>
                                            <td>${data[i].subject?.name}</td>
                                            <td>
                                                <div class="ml-2 d-flex">
                                                    <img src="${image_path}" alt="blog image"
                                                        class="img-fluid img-50 rounded-circle blur-up lazyloaded" width="100">
                                                </div>
                                            </td>
                                            <td>${data[i].is_activate == 1 ? '<span class="badge badge-info">active</span>' : '<span class="badge badge-danger">un active</span>'}</td>
                                            <td>
                                                <ul class="nav navbar-center navbar-top-links" style="border-radius: 15px;">
                                                    <li class="dropdown">
                                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                             actions <b class="caret"></b>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-user">
                                                            <li>
                                                                <a href="${edit_route}" style="text-decoration: none; color: white; width: 75px;margin:auto" class="btn btn-success">
                                                                    edit
                                                                </a>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li >
                                                                <button class="dropdown-item btn btn-danger openDeleteFrom" data-toggle="modal" data-target="#myModalDelete" data-id="${data[i].id}">
                                                                    delete
                                                                </button>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <button class="dropdown-item btn btn-priamry openActivationFrom" data-toggle="modal" data-target="#myModalActivation" data-id="${data[i].id}">
                                                                    activation
                                                                </button>
                                                            </li>
                                                            <li class="divider"></li>
                                                            <li>
                                                                <button class="dropdown-item btn btn-info openActivationFrom" data-toggle="modal" data-target="#myModalSortBook" data-id="${data[i].id}" data-order="${data[i].order}">
                                                                    sort blog
                                                                </button>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    `
                                }
                                document.getElementById("tableShowData").innerHTML += records
                                offset += data.length
                                length += data.length
                                showItems.innerHTML = Number(length)
                                let btnData = `<button type="button" name="load_more_button" style="width: 350px;" class="btn btn-info form-control px-5" id="load_more_button">عرض المزيد</button>`
                                $('#load_more_button').remove();
                                document.getElementById("load_more").innerHTML = btnData
                            } else if (data.length === 0) {
                                let btnNoData = `<button type="button" name="load_more_button" style="width: 350px;" class="btn btn-primary form-control px-5" id="load_more_button_remove">No Data</button>`
                                $('#load_more_button').remove();
                                document.getElementById("load_more").innerHTML = btnNoData
                            }
                        }
                    })
                }
            });
        });

        $(document).on('keyup', '.data_search', function() {
            var q = $(this).val();
            var urlPath = "{{ route('admin/blogs/search') }}";
            event.preventDefault();
            search_in_data(_token, q, urlPath)
        });

        $(document).on('change', '.data_search_search', function() {
            var q = $(this).val();
            var record = $(this).attr('name');
            var urlPath = "{{ route('admin/blogs/search/byColumn') }}";
            event.preventDefault();
            search_in_data(_token, q, urlPath, record)
        });

        function search_in_data(_token, q, urlPath, record = '') {
            let records = ``
            $.ajax({
                url: urlPath,
                method: "POST",
                data: {
                    q: q,
                    record: record,
                    _token: _token
                },
                success: function(data) {
                    if (data.length > 0) {
                        for (let i = 0; i < data.length; i++) {

                            q == '' ? offset = <?php echo PAGINATION_COUNT ?> : ''
                            image_path =  "{{ asset('') }}" + data[i].img;
                            edit_route =  "{{ route('admin/blogs/edit') }}" + '/' + data[i].id;
                            records += `
                                <tr class="odd gradeX text-center">
                                    <td>${data[i].id}</td>
                                    <td>${data[i].title ?? data[i].translations[0].title}</td>
                                    <td>${data[i].service?.name}</td>
                                    <td>${data[i].country?.name}</td>
                                    <td>${data[i].section?.name}</td>
                                    <td>${data[i].subject?.name}</td>
                                    <td>
                                        <div class="ml-2 d-flex">
                                            <img src="${image_path}" alt="blog image"
                                                class="img-fluid img-50 rounded-circle blur-up lazyloaded" width="100">
                                        </div>
                                    </td>
                                    <td>${data[i].is_activate == 1 ? '<span class="badge badge-info">active</span>' : '<span class="badge badge-danger">un active</span>'}</td>
                                    <td>
                                        <ul class="nav navbar-center navbar-top-links" style="border-radius: 15px;">
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                                        actions <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu dropdown-user">
                                                    <li>
                                                        <a href="${edit_route}" style="text-decoration: none; color: white; width: 75px;margin:auto" class="btn btn-success">
                                                            edit
                                                        </a>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li >
                                                        <button class="dropdown-item btn btn-danger openDeleteFrom" data-toggle="modal" data-target="#myModalDelete" data-id="${data[i].id}">
                                                            delete
                                                        </button>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <button class="dropdown-item btn btn-priamry openActivationFrom" data-toggle="modal" data-target="#myModalActivation" data-id="${data[i].id}">
                                                            activation
                                                        </button>
                                                    </li>
                                                    <li class="divider"></li>
                                                    <li>
                                                        <button class="dropdown-item btn btn-info openActivationFrom" data-toggle="modal" data-target="#myModalSortBook" data-id="${data[i].id}" data-order="${data[i].order}">
                                                            sort blog
                                                        </button>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            `
                        }
                        document.getElementById("tableShowData").style.display = null
                        document.getElementById("tableShowData").innerHTML = records
                        $('#load_more_button').remove();
                        $('#load_more_button_remove').remove();
                        length = data.length
                        showItems.innerHTML = Number(length)
                        if (data[0].searchButton == 1) {
                            let btnData = `<button type="button" name="load_more_button" style="width: 350px;" class="btn btn-info form-control px-5"id="load_more_button">عرض المزيد</button>`
                            document.getElementById("load_more").innerHTML = btnData
                        }
                    } else if (data.length === 0) {
                        length = data.length
                        showItems.innerHTML = Number(length)
                        document.getElementById("tableShowData").style.display = 'none'
                        let btnNoData = `<button type="button" name="load_more_button" style="width: 350px;" class="btn btn-primary form-control px-5" id="load_more_button_remove">No Data</button>`
                        document.getElementById("load_more").innerHTML = btnNoData
                    }
                }
            })
        }
    </script>
@endsection
