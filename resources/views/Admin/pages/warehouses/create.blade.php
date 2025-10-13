@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.warehouses') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>
            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.warehouses.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.warehouses.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
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
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.email') }}</b></label>
                            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="phone"><b>{{ trans('backend.phone') }} 1</b></label>
                            <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ old('phone') }}">
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="phone2"><b>{{ trans('backend.phone') }} 2</b></label>
                            <input type="text" name="phone2" id="phone2" class="form-control {{ $errors->has('phone2') ? 'is-invalid' : '' }}" value="{{ old('phone2') }}">
                            @if ($errors->has('phone2'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone2') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address"><b>{{ trans('backend.address') }}</b></label>
                            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ old('address') }}">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="responsible_person"><b>{{ trans('backend.responsible_person') }}</b></label>
                            <input type="text" name="responsible_person" id="responsible_person" class="form-control {{ $errors->has('responsible_person') ? 'is-invalid' : '' }}" value="{{ old('responsible_person') }}">
                            @if ($errors->has('responsible_person'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('responsible_person') }}</strong>
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
                    <div class="col-md-12">
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
    $('#description_ar').summernote({
        height : 300
    });
    $('#description_en').summernote({
        height : 300
    });

    // Validate Form ...
    //   $('#myForm').validate({
    //       rules : {
    //         first_name : { required : true , minlength: 3 },
    //         last_name : { required : true , minlength: 3 },
    //         email : { required : true , email: true },
    //         phone : { required : true , minlength: 8, maxlength:20 },
    //         password : { required : true , minlength: 6 },
    //         password_confirmation : { required : true , equalTo : '#password', minlength: 6 },
    //       },
    //       messages : {

    //       },
    //       errorEelement : 'span',
    //       errorPlacement : function(error , element){
    //           element.closest('.form-group').append(error);
    //       },

    //   }); 

});
</script>
@endpush