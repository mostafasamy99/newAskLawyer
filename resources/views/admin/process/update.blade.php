@extends('layouts.admin.home')

<!-- title page -->
@section('title')
    <title>Process</title>
@endsection

<!-- custom css -->
@section('css')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-8">
            {{-- <h1 class="page-header">Process Edit</h1> --}}
        </div>
        <div class="col-lg-4">
            <div class="breadcrumb_container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin/index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin/process/index')}}/0/{{PAGINATION_COUNT}}">Process</a></li>
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
                    <div class="panel-title pull-left">Process Form</div>
                </div>
                <div class="panel-body">
                    @isset($process)
                        <form role="form" action="{{url(route('admin/process/update', $process->id))}}" method="post" enctype="multipart/form-data">
                            <div class="tab-content">
                                @csrf
                                
                                <!-- <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Content</span>
                                    <textarea class="form-control ckeditor content" name="content" placeholder="Content">{!! $process->content !!}</textarea>
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: black;">Upload Image</span>
                                    <input name="photo" type="file" class="form-control" placeholder="">
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon" style="color: red;"></span>
                                    <select class="form-control" name="img_dir">
                                        <option value="">اتجاه الصوره</option>
                                        <option value="1" {{ $process->img_dir == 1 ? 'selected' : '' }}>يمين</option>
                                        <option value="2" {{ $process->img_dir == 2 ? 'selected' : '' }}>شمال</option>
                                    </select>
                                </div> -->
                                <div class="col-xs-12">
                                    <div class="col-xs-2">
                                        <button type="button" onclick="addsteps(this.form)" class="btn btn-info">Add Steps</button>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="margin-top: 10px;"></div>
                                <div class="stepComponentsArea">
                                    @if(count($process->steps) > 0)
                                        @php $rowNo = 1; @endphp 
                                        @foreach($process->steps as $step)
                                            <div class="col-xs-12 stepComponentArea-{{$rowNo}}">
                                                <div class="col-xs-8 step-component-area">
                                                    <div class="col-xs-5">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon" style="color: red;">*</span>
                                                            <input name="proces_steps[{{$rowNo}}][content_ar]" type="text" value="{{$step->translate('ar')?->content}}" class="form-control" placeholder="step ar">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-5">
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon" style="color: red;">*</span>
                                                            <input name="proces_steps[{{$rowNo}}][content_en]" type="text" value="{{$step->translate('en')?->content}}" class="form-control" placeholder="step en">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-2">
                                                        <button type="button" onclick="removeSteps('.stepComponentArea-{{$rowNo}}')" class="btn btn-danger">-</button>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $rowNo++; @endphp 
                                        @endforeach
                                    @endif
                                </div>
                                <div class="col-xs-12" style="margin-top: 10px;"></div>
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
    
    var rowNo = 200;
    function addsteps(params) {
        row = `
            <div class="col-xs-12 stepComponentArea-${rowNo}">
                <div class="col-xs-8 step-component-area">
                    <div class="col-xs-5">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="color: red;">*</span>
                            <input name="proces_steps[${rowNo}][content_ar]" type="text" class="form-control" placeholder="step ar">
                        </div>
                    </div>
                    <div class="col-xs-5">
                        <div class="form-group input-group">
                            <span class="input-group-addon" style="color: red;">*</span>
                            <input name="proces_steps[${rowNo}][content_en]" type="text" class="form-control" placeholder="step en">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <button type="button" onclick="removeSteps('.stepComponentArea-${rowNo}')" class="btn btn-danger">-</button>
                    </div>
                </div>
            </div>
        `;
        $('.stepComponentsArea').append(row);
        rowNo++;
    }
    function removeSteps(record) {
        $(record).remove();
    }
</script>
@endsection
