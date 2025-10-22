@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-edit"></i> {{ trans('backend.edit') }} {{ trans('backend.suppliers') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>
            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.suppliers.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.suppliers.update' , $supplier->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="supplier_type"><b>{{ trans('backend.supplier_type') }}</b></label>
                            <select name="supplier_type" id="supplier_type" class="form-control select2" style="width:100%">
                                <option value="">..........</option>
                                <option value="person" {{ $supplier->supplier_type == 'person' ? 'selected' : '' }}>{{ trans('backend.person') }}</option>
                                <option value="company" {{ $supplier->supplier_type == 'company' ? 'selected' : '' }}>{{ trans('backend.company') }}</option>
                            </select>
                            @if ($errors->has('supplier_type'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('supplier_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.name') }}</b></label>
                            <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $supplier->name }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"><b>{{ trans('backend.email') }}</b></label>
                            <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $supplier->email }}">
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
                            <input type="text" name="phone" id="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ $supplier->phone }}">
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
                            <input type="text" name="phone2" id="phone2" class="form-control {{ $errors->has('phone2') ? 'is-invalid' : '' }}" value="{{ $supplier->phone2 }}">
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
                            <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" value="{{ $supplier->address }}">
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.logo') }}</b></label>
                            <input type="file" name="logo" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('logo') ? 'is-invalid' : '' }}">
                            @if ($errors->has('logo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('logo') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:200px;height:150px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($supplier->logo) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center" style="margin-top:30px">
                            <button type="submit" class="btn btn-primary btn-block" style="font-size:16px"><i class="fa fa-refresh fa-fw fa-lg"></i> {{ trans('backend.update') }}</button>
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