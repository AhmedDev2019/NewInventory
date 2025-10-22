@extends('Admin.layouts.master')

@section('pageTitle') 
    <i class="fa fa-plus-circle"></i> {{ trans('backend.add') }} {{ trans('backend.purchases') }} 
@endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('backend.enter') }} {{ trans('backend.infos') }}</h3>
            <!-- Start Button  -->
            <div class="button-page-header" style="margin-top:5px">
                <a class="btn btn-block btn-warning" href="{{ route('admin.purchases.index') }}">
                <i class="fa fa-reply fa-fw fa-lg"></i> {{ trans('backend.back') }}</a>
            </div>
        </div>

        <div class="box-body">
                
            <form id="myForm" action="{{ route('admin.purchases.store') }}" method="POST" class="userForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}

                <!-- Start Row  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date"><b>{{ trans('backend.date') }}</b></label>
                            <input type="date" name="date" id="date" value="{{ now()->format('Y-m-d') }}" class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" value="{{ old('date') }}">
                            @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="warehouse_id"><b>{{ trans('backend.warehouse') }}</b></label>
                            <select name="warehouse_id" id="warehouse_id" class="form-control select2">
                                <option value="">...........</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                        @if( app()->getLocale() == 'ar' )
                                            {{ $warehouse->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{ $warehouse->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="supplier_id"><b>{{ trans('backend.supplier') }}</b></label>
                            <select name="supplier_id" id="supplier_id" class="form-control select2">
                                <option value="">...........</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_id"><b>{{ trans('backend.product') }}</b></label>
                            <input type="product_id" name="product_id" id="product_id" class="form-control {{ $errors->has('product_id') ? 'is-invalid' : '' }}" value="{{ old('product_id') }}">
                            @if ($errors->has('product_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('product_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 products-content">
                        
                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-primary"><strong>{{ trans('backend.products_table') }}</strong></h4>

                        <div class="">
                            <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th><b>{{ trans('backend.product') }}</b></th>
                                        <th><b>{{ trans('backend.net_unit_price') }}</b></th>
                                        <th><b>{{ trans('backend.stock') }}</b></th>
                                        <th><b>{{ trans('backend.quantity') }}</b></th>
                                        <th><b>{{ trans('backend.discount') }}</b></th>                            
                                        <th><b>{{ trans('backend.sub_total') }}</b></th>
                                        <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <hr>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prices-details">
                            <ul class="list-group">
                                <li class="list-group-item"  style="display:flex;justify-content:space-between">
                                    <h4><b>{{ trans('backend.discount') }}:</b></h4>
                                    <h4><b>0.00</h4>
                                </li>
                                <li class="list-group-item"  style="display:flex;justify-content:space-between">
                                    <h4><b>{{ trans('backend.shipping') }}:</b></h4>
                                    <h4><b>0.00</h4>
                                </li>
                                <li class="list-group-item"  style="display:flex;justify-content:space-between">
                                    <h4><b>{{ trans('backend.grand_total') }}:</b></h4>
                                    <h4><b>0.00</h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="discount"><b>{{ trans('backend.discount') }}</b></label>
                            <input type="discount" name="discount" id="discount" value="0.00" class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" value="{{ old('discount') }}">
                            @if ($errors->has('discount'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('discount') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="shipping"><b>{{ trans('backend.shipping') }}</b></label>
                            <input type="shipping" name="shipping" id="shipping" value="0.00" class="form-control {{ $errors->has('shipping') ? 'is-invalid' : '' }}" value="{{ old('shipping') }}">
                            @if ($errors->has('shipping'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('shipping') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status"><b>{{ trans('backend.status') }}</b></label>
                            <select name="status" id="status" class="form-control select2">
                                <option value="">...........</option>
                                <option value="pending">{{ trans('backend.pending') }}</option>
                                <option value="ordered">{{ trans('backend.ordered') }}</option>
                                <option value="received">{{ trans('backend.received') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="notes"><b>{{ trans('backend.notes') }}</b></label>
                            <textarea name="notes" id="notes" rows="4" class="form-control">{{ old('notes') }}</textarea>
                            @if ($errors->has('notes'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('notes') }}</strong>
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

    // Get Warehouse Related Products When Search .
    $(document).on('keyup' , '#product_id' , function(e){
        e.preventDefault();

        var searchedValue = $(this).val();
        var warehouse_id = $('#warehouse_id').val();

        if( searchedValue ){
            if( warehouse_id ){
                console.log(warehouse_id);
                $.ajax({
                    url : "{{ route('admin.purchases.search-products') }}",
                    type : 'GET',
                    data : { warehouse_id : warehouse_id , searchedValue : searchedValue },
                    beforeSend(data){
                        console.log('Sending ...');
                    },
                    success : function(data){
                        console.log(data);
                        $('.products-content').html(data);
                    },
                    error : function(data){
                        console.log(data);
                    }
                });

            }else{
                console.log('Please Select Warehouse !');
                swal({
                    title: "{{ trans('backend.select_warehouse') }}",
                    icon: "warning",
                    button : "{{ trans('backend.ok') }}"
                });
            }
        }else{
            $('.products-content').html("");
            swal({
                title: "{{ trans('backend.select_product') }}",
                icon: "warning",
                button : "{{ trans('backend.ok') }}"
            });
        }
        
    });

});
</script>
@endpush