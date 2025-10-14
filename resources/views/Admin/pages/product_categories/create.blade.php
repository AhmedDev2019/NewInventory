@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.product_categories') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>
            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.product_categories.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.product_categories.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar"><b>{{ trans('backend.name_ar') }}</b></label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" value="{{ old('name_ar') }}">
                            @if ($errors->has('name_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_en"><b>{{ trans('backend.name_en') }}</b></label>
                            <input type="text" name="name_en" id="name_en" class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" value="{{ old('name_en') }}">
                            @if ($errors->has('name_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_ar"><b>{{ trans('backend.description_ar') }}</b></label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="form-control">{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description_en"><b>{{ trans('backend.description_en') }}</b></label>
                            <textarea name="description_en" id="description_en" rows="4" class="form-control">{{ old('description_en') }}</textarea>
                            @if ($errors->has('description_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.icon') }}</b></label>
                            <input type="file" name="icon" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('icon') ? 'is-invalid' : '' }}">
                            @if ($errors->has('icon'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('icon') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:250px;height:200px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset('uploads/product_categories/default.png') }}" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="text-center" style="margin-top:30px">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.save') }}</button>
                        </div>
                    </div>
                    
                </div>
                <!-- End Row  -->

                
            </form>
                    
        </div>    

    </div>

@endsection


@push('scripts')
<script>
$(document).ready(function(){

    // Summernote .
    $('#description').summernote({
        height : 300
    });

});
</script>
@endpush