@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-edit"></i> {{ trans('backend.edit') }} {{ trans('backend.products') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>
            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.products.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.products.update' , $product->id) }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name_ar"><b>{{ trans('backend.name_ar') }}</b></label>
                            <input type="text" name="name_ar" id="name_ar" class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" value="{{ $product->name_ar }}">
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
                            <input type="text" name="name_en" id="name_en" class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" value="{{ $product->name_en }}">
                            @if ($errors->has('name_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand_id"><b>{{ trans('backend.brands') }}</b></label>
                            <select name="brand_id" id="brand_id" class="form-control select2">
                                <option value="">...........</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        @if( app()->getLocale() == 'ar' )
                                            {{ $brand->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{ $brand->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('brand_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('brand_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_category_id"><b>{{ trans('backend.product_categories') }}</b></label>
                            <select name="product_category_id" id="product_category_id" class="form-control select2">
                                <option value="">...........</option>
                                @foreach($product_categories as $product_category)
                                    <option value="{{ $product_category->id }}" {{ $product->product_category_id == $product_category->id ? 'selected' : '' }}>
                                        @if( app()->getLocale() == 'ar' )
                                            {{ $product_category->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{ $product_category->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_category_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('product_category_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="supplier_id"><b>{{ trans('backend.supplier') }}</b></label>
                            <select name="supplier_id" id="supplier_id" class="form-control select2">
                                <option value="">...........</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('supplier_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('supplier_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="warehouse_id"><b>{{ trans('backend.warehouse') }}</b></label>
                            <select name="warehouse_id" id="warehouse_id" class="form-control select2">
                                <option value="">...........</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ $product->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                        @if( app()->getLocale() == 'ar' )
                                            {{ $warehouse->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{ $warehouse->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('warehouse_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('warehouse_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="code"><b>{{ trans('backend.code') }}</b></label>
                            <input type="text" name="code" id="code" class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" value="{{ $product->code }}">
                            @if ($errors->has('code'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('code') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price"><b>{{ trans('backend.price') }}</b></label>
                            <input type="text" name="price" id="price" class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" value="{{ $product->price }}">
                            @if ($errors->has('price'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount"><b>{{ trans('backend.discount') }}</b></label>
                            <input type="text" name="discount" id="discount" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" value="{{ $product->discount }}">
                            @if ($errors->has('discount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity"><b>{{ trans('backend.quantity') }}</b></label>
                            <input type="number" name="quantity" id="quantity" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" value="{{ $product->quantity }}">
                            @if ($errors->has('quantity'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('quantity') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock_alert"><b>{{ trans('backend.stock_alert') }}</b></label>
                            <input type="number" name="stock_alert" id="stock_alert" class="form-control {{ $errors->has('stock_alert') ? 'is-invalid' : '' }}" value="{{ $product->stock_alert }}">
                            @if ($errors->has('stock_alert'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('stock_alert') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status"><b>{{ trans('backend.status') }}</b></label>
                            <select name="status" id="status" class="form-control select2">
                                <option value="">...........</option>
                                <option value="pending" {{ $product->status == 'pending' ? 'selected' : '' }}>{{ trans('backend.pending') }}</option>
                                <option value="received" {{ $product->status == 'received' ? 'selected' : '' }}>{{ trans('backend.received') }}</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_ar"><b>{{ trans('backend.description_ar') }}</b></label>
                            <textarea name="description_ar" id="description_ar" rows="4" class="form-control">{{ $product->description_ar }}</textarea>
                            @if ($errors->has('description_ar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_ar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description_en"><b>{{ trans('backend.description_en') }}</b></label>
                            <textarea name="description_en" id="description_en" rows="4" class="form-control">{{ $product->description_en }}</textarea>
                            @if ($errors->has('description_en'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description_en') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="exampleInputFile"><b>{{ trans('backend.image') }}</b></label>
                            <input type="file" name="image" id="exampleInputFile" style="padding: 10px;height:45px" class="form-control image {{ $errors->has('image') ? 'is-invalid' : '' }}">
                            @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                            @endif
                            <div class="imagePreview">
                                <img style="width:250px;height:180px;margin-top:5px;object-fit:contain" class="image-preview img-thumbnail" src="{{ asset($product->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label><b>{{ trans('backend.image_gallery') }}</b></label>
                            <input type="file" name="multiple_images[]" style="padding: 10px;height:45px" class="form-control multiImages" id="multiple_images" multiple>
                            <div class="" id="multiple_images"></div>
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

    // Summernote .
    $('#description_ar').summernote({
        height : 300
    });
    $('#description_en').summernote({
        height : 300
    });

    // Multiple Images .
    $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img style="margin:10px;object-fit:contain">').addClass('img-thumbnail').attr('src', e.target.result).width(230).height(200).after('<button style="display:inline-block">Delete</button>'); //create image element 
                    //   var button = $('<br /> <button style="display:inline-block">Delete</button>').addClass('btn btn-danger');

                      $('#multi_img_preview').append(img); //append image to output element
                    //   $('#multi_img_preview').append(button); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

          $('#multi_img_preview').html("");
          
      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
    });

    // Multiple Images Method 2 .
    if (window.File && window.FileList && window.FileReader) {
        $("#multiple_images").on("change", function(e) {
            var files = e.target.files,
            filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove image</span>" +
                    "</span>").insertAfter("#multiple_images");

                

                /*
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });*/

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }

    // Remove Button Of Multiple Images.
    $(document).on('click', '.remove', function(){
        var pips = $('.pip').toArray();
        var $selectedPip = $(this).parent('.pip');
        var index = pips.indexOf($selectedPip[0]);

        var dt = new DataTransfer();
        var files = $("#multiple_images")[0].files;

        for (var fileIdx = 0; fileIdx < files.length; fileIdx++) {
            if (fileIdx !== index) {
                dt.items.add(files[fileIdx]);
            }
        }

        $("#multiple_images")[0].files = dt.files;

        $selectedPip.remove();
    });

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