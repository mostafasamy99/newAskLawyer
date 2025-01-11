@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Contacts</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Contact Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/contacts/index')}}/0/{{PAGINATION_COUNT}}">Contacts</a></li>
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
                    <div class="panel-title pull-left">Contacts Form</div>
                </div>
                <div class="panel-body">
                    @isset($contact)
                        <form role="form" action="{{url(route('admin/contacts/update', $contact->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                

                                <!-- <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;">*</span>
                                    <input name="name" type="text" class="form-control" placeholder="name" value="{{$contact->name}}">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div> -->
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
