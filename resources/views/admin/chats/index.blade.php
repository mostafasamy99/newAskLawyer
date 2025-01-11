@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Chats</title>
@endsection

<!-- custom css -->
@section('css')
    
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Chats</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/chats/index')}}">Chats</a></li>
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
                    Chats Viwes
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    @include('flash::message')
                    <div class="row">
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6 text-right">
                            <div id="dataTables-example_filter" class="dataTables_filter">
                                <!-- <label><input placeholder="search" type="search" class="form-control input-sm data_search" aria-controls="dataTables-example"></label> -->
                            </div>
                        </div>
                    </div>
                    <div class="dataTable_wrapper">
                        <div class="row">
                            @csrf
                            <div class="col-xs-4">
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <select class="form-control" name="lawyer_id" id="lawyers">
                                        <option value="">lawyers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <select class="form-control" name="user_id" id="users">
                                        <option value="">users</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group input-group">
                                    <button class="btn btn-success searchChat">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <section class="message-area">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="chat-area">

                                        <!-- chatbox -->
                                        <div class="chatbox">
                                            <div class="modal-dialog-scrollable">
                                                <div class="modal-content">

                                                    <div class="modal-body">
                                                        <div class="msg-body">
                                                            <ul id="messages-area">
                                                                <!-- <li class="sender">
                                                                    <p> Hey, Are you there? </p>
                                                                    <span class="time">10:06 am</span>
                                                                </li>
                                                                <li class="sender">
                                                                    <p> Hey, Are you there? </p>
                                                                    <span class="time">10:16 am</span>
                                                                </li>
                                                                <li class="repaly">
                                                                    <p>yes!</p>
                                                                    <span class="time">10:20 am</span>
                                                                </li>
                                                                <li class="sender">
                                                                    <p> Hey, Are you there? </p>
                                                                    <span class="time">10:26 am</span>
                                                                </li>
                                                                <li class="sender">
                                                                    <p> Hey, Are you there? </p>
                                                                    <span class="time">10:32 am</span>
                                                                </li>
                                                                <li class="repaly">
                                                                    <p>How are you?</p>
                                                                    <span class="time">10:35 am</span>
                                                                </li>
                                                                <li>
                                                                    <div class="divider"><h6>Today</h6></div>
                                                                </li>
                                                                <li class="repaly">
                                                                    <p> yes, tell me</p>
                                                                    <span class="time">10:36 am</span>
                                                                </li>
                                                                <li class="repaly">
                                                                    <p>yes... on it</p>
                                                                    <span class="time">junt now</span>
                                                                </li> -->
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </section>
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
    var _token = $('input[name="_token"]').val();
    $('#lawyers').select2({
        ajax: {
            url: "{{ route('get/lawyers') }}",
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
    $('#users').select2({
        ajax: {
            url: "{{ route('get/users') }}",
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
    $(document).on('click', '.searchChat', function(){
        let records = ``;
        var user = $('#users').val();
        var lawyer = $('#lawyers').val();
        if (user && lawyer) {
            $.ajax({
                url: `{{ route("admin/chats/search")}}`,
                method: "POST",
                data: {
                    user: user,
                    lawyer: lawyer,
                    _token: _token
                },
                success: function(data) {
                    if (data.id > 0 && data.messages.length > 0) {
                        for (let i = 0; i < data.messages.length; i++) {

                            if (data.messages[i].senderable_type === "App\\Models\\Lawyer") {
                                messageClass = 'sender';
                            }else{
                                messageClass = 'repaly';
                            }
                            records += `
                                <li class="${messageClass}">
                                    <p>${data.messages[i].body}</p>
                                    <span class="time">${data.messages[i].created_at.split('T')[1].split('.')[0]}</span>
                                </li>
                            `;
                        }
                        document.getElementById("messages-area").style.display = null;
                        document.getElementById("messages-area").innerHTML = records;
                    } else if (data.length === 0) {
                        document.getElementById("messages-area").style.display = 'none';
                        alert("Data Not Found !");
                    }
                }
            })
        }else{
            alert("requried to select lawyer and user !");
        }
    });
</script>
@endsection