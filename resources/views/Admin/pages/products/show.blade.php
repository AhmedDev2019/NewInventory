@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-eye"></i> {{ trans('backend.show') }} {{ trans('backend.products') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('backend.infos') }}</h3>

            <!-- Start Button  -->
            @if( $product->active == 0 )
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-success" href="{{ route('admin.products.activation' , $product->id) }}">
                    <i class="fa fa-check fa-fw fa-lg"></i> {{ trans('backend.activation') }}</a>
                </div>
            @else
                <div class="button-page-header" style="margin-top:5px">
                    <a class="btn btn-block btn-danger" href="{{ route('admin.products.activation' , $product->id) }}">
                    <i class="fa fa-close fa-fw fa-lg"></i> {{ trans('backend.disable') }}</a>
                </div>
            @endif
            
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-info" href="{{ route('admin.products.edit' , $product->id) }}">
                <i class="fa fa-pencil fa-fw fa-lg"></i> {{ trans('backend.edit') }}</a>
            </div>

            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.products.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
            
        </div>

        <div class="box-body">
                
            <form id="myForm" action="" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <!-- <label for="exampleInpu style="color:#337ab7"tFile"><b>{{ trans('backend.image') }}</b></label> -->
                            <div class="imagePreview">
                                <img style="width:100%;height:300px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($product->image) }}" alt="">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-8">
                        
                        <!-- Main Info  -->
                        <div class="row">
                            
                            <div class="col-md-12" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->name_en }}
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.product_category') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->product_category->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->product_category->name_en }}
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.brand') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->brand->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->brand->name_en }}
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.warehouse') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->warehouse->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->warehouse->name_en }}
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.supplier') }}</b></label>
                                    <h4 style="margin:0">
                                        {{  $product->supplier->name }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.price') }}</b></label>
                                    <h4 style="margin:0">
                                        {{  number_format($product->price,2) }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.discount') }}</b></label>
                                    <h4 style="margin:0">
                                        {{  number_format($product->discount,2) }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.quantity') }}</b></label>
                                    <h4 style="margin:0">
                                        {{  $product->quantity }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.stock_alert') }}</b></label>
                                    <h4 style="margin:0">
                                        {{  $product->stock_alert }}
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.status') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $product->status == 'pending' )
                                            <span class="badge label-warning">{{ trans('backend.pending') }}</span>
                                        @elseif( $product->status == 'received' )
                                            <span class="badge label-primary">{{ trans('backend.received') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.status') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( $product->active == 1 )
                                            <span class="badge label-success">{{ trans('backend.active') }}</span>
                                        @elseif( $product->active == 0 )
                                            <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Description  -->
                        <div class="row">
                            <div class="col-md-12" style="margin-bottom:15px">
                                <div class="form-group">
                                    <label for="name" style="color:#337ab7"><b>{{ trans('backend.name') }}</b></label>
                                    <h4 style="margin:0">
                                        @if( app()->getLocale() == 'ar' )
                                            {!!  $product->description_ar !!}
                                        @elseif( app()->getLocale() == 'en' )
                                            {!!  $product->description_en !!}
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        <div>
                        
                        <!-- Datetime info -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.created_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $product->created_at->format('Y-m-d') }}</p>
                                        <p>{{ $product->created_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
			                <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name" style="color:#337ab7"><b>{{ trans('backend.updated_at') }}</b></label>
                                    <h4 style="margin:0">
                                        <p>{{ $product->updated_at->format('Y-m-d') }}</p>
                                        <p>{{ $product->updated_at->format('h:i A') }}</p>
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                
            </form>
                    
        </div>   

    </div>

    <br><br>

    <div class="box">

        <div class="box-header with-border">
            <h3 class="">{{ trans('backend.image_gallery') }}</h3> &nbsp;&nbsp;&nbsp;&nbsp;
            <!-- Start Button  -->
            <div class="" style="margin-top:5px">
                <a class="btn btn-block bg-olive add-single-image" href="javascript:void">
                <i class="fa fa-plus-circle fa-lg fa-fw"></i> {{ trans('backend.add_images_to_gallery') }}</a>
            </div>
        </div>

        <div class="box-body">

            <!-- Start Row  -->
            <div class="">
                @php
                    $product_images = App\Models\ProductImage::where('product_id',$product->id)->get();
                @endphp
                
                <hr>
                    <!-- <a href="" class="btn btn-primary add-single-image"><i class="fa fa-plus-circle fa-lg fa-fw"></i> {{ trans('backend.add_images_to_gallery') }}</a> -->
                
                <div class="row">
                    @foreach($product_images as $img)
                        <div class="col-md-4 col-{{ $img->id }}" style="margin:20px 0">
                            <img style="width:100%;height:250px;object-fit:contain" class="img-thumbnail" src="{{ asset($img->image) }}" alt="">
                            <div class="buttons text-center" style="display:flex;justify-content:center;margin:5px">
                                <button class="btn btn-info edit-single-image" data-id="{{ $img->id }}"><i class="fa fa-pencil"></i> {{ trans('backend.edit') }}</button>
                                &nbsp;&nbsp;
                                <button class="btn btn-danger delete-single-image" data-id="{{ $img->id }}"><i class="fa fa-trash"></i> {{ trans('backend.delete') }}</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
                    
        </div>    

    </div>

    <!-- Edit Image Modal  -->
    <div class="modal fade edit-single-image-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('backend.edit_image') }}</h4>
                </div>
                <div class="modal-body">
                <form id="editImageForm" action="{{ route('admin.products.update-single-image') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <input type="hidden" name="imageId" class="imageId" id="imageId">
                    
                        
                            <div class="form-group">
                                <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                                <div class="imagePreview">
                                    <img style="width:100%;margin-top:5px" class="image-preview2 img-thumbnail" src="{{ asset('uploads/products/default.png') }}" alt="">
                                </div>
                                <br>
                                <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image2 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('backend.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('backend.update') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Single Image Modal  -->
    <div class="modal fade add-single-image-modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{ trans('backend.add_image') }}</h4>
                </div>
                <div class="modal-body">
                <form id="addImageForm" action="{{ route('admin.products.store-single-image') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                            <input type="hidden" name="product_id" class="product_id" id="product_id" value="{{ $product->id }}">
                    
                        
                            <div class="form-group">
                                <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                                <div class="imagePreview">
                                    <img style="width:100%;margin-top:5px" class="image-preview2 img-thumbnail" src="{{ asset('uploads/products/default.png') }}" alt="">
                                </div>
                                <br>
                                <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image2 {{ $errors->has('image') ? 'is-invalid' : '' }}">
                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('backend.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ trans('backend.add') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
<script>
$(document).ready(function(){

  // Delete Single Image .
    $(document).on('click' , '.delete-single-image' , function(e){
        e.preventDefault();

        var image_id = $(this).data('id');

        if( confirm("{{ trans('backend.confirm_delete') }}") ){
            $.ajax({
                url : "{{ route('admin.products.delete-single-image') }}",
                type : 'GET',
                data : { image_id : image_id },
                success : function(data){
                    $('.col-'+image_id).remove();
                }
            })
        }

    });

    // Edit Single Image .
    $(document).on('click' , '.edit-single-image' , function(e){
        e.preventDefault();

        var image_id = $(this).data('id');

        $('.edit-single-image-modal').modal('show');
        $('.imageId').val(image_id);

        if( image_id ){
            $.ajax({
            url : "{{ route('admin.products.edit-single-image') }}",
            type : 'GET',
            data : { image_id : image_id },
                success : function(data){
                    $('.image-preview2').attr('src' , data);
                }
            })
        }

    });

    // Update Single Image .
    $(document).on('submit' , '#editImageForm' , function(e){
        e.preventDefault();

            var url = $(this).attr('action');
            var image_id = $('#imageId').val();

            $.ajax({
                url : url,
                type : 'POST',
                contentType: false,
                processData: false,
                data : new FormData(this),
                success : function(data){
                    location.reload();
                }
            })

    });

    // Add Single Image .
    $(document).on('click' , '.add-single-image' , function(e){
        e.preventDefault();

        $('.add-single-image-modal').modal('show');

    });

    // Update Single Image .
    $(document).on('submit' , '#addImageForm' , function(e){
        e.preventDefault();

            var url = $(this).attr('action');

            $.ajax({
                url : url,
                type : 'POST',
                contentType: false,
                processData: false,
                data : new FormData(this),
                success : function(data){
                    console.log(data);
                    location.reload();
                }
            })

    });

});
</script>
@endpush