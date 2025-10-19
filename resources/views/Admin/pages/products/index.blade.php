@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-shopping-bag"></i> {{ trans('backend.products') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                {{ trans('backend.info') }} {{ trans('backend.products') }}
            </h3>
            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('admin.products.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> {{ trans('backend.create_new') }}</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <!-- Search Form  -->
            <form id="searchForm" action="{{ route('admin.products.index') }}" method="GET">
                <div class="">
                    <div class="col-md-3">
                        <label for="search"><b>{{ trans('backend.search') }}</b></label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="{{ trans('backend.search') }}" value="{{ request()->search }}">
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="product_category_id"><b>{{ trans('backend.product_categories') }}</b></label>
                            <select name="product_category_id" id="product_category_id" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                @foreach($product_categories as $product_category)
                                    <option value="{{ $product_category->id }}" {{ request()->product_category_id == $product_category->id ? 'selected' : '' }}>
                                        @if( app()->getLocale() == 'ar' )
                                            {{ $product_category->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{ $product_category->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="brand_id"><b>{{ trans('backend.brand') }}</b></label>
                            <select name="brand_id" id="brand_id" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ request()->brand_id == $brand->id ? 'selected' : '' }}>
                                        @if( app()->getLocale() == 'ar' )
                                            {{ $brand->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{ $brand->name_en }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="order"><b>{{ trans('backend.order') }}</b></label>
                            <select name="order" id="order" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                <option value="desc" {{ request()->order == 'desc' ? 'selected' : '' }}>{{ trans('backend.latest') }}</option>
                                <option value="asc" {{ request()->order == 'asc' ? 'selected' : '' }}>{{ trans('backend.oldest') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="warehouse_id"><b>{{ trans('backend.warehouse') }}</b></label>
                            <select name="warehouse_id" id="warehouse_id" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                @foreach($warehouses as $warehouse)
                                    <option value="{{ $warehouse->id }}" {{ request()->warehouse_id == $warehouse->id ? 'selected' : '' }}>
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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="supplier_id"><b>{{ trans('backend.supplier') }}</b></label>
                            <select name="supplier_id" id="supplier_id" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ request()->supplier_id == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="status"><b>{{ trans('backend.status') }}</b></label>
                            <select name="status" id="status" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>{{ trans('backend.pending') }}</option>
                                <option value="received" {{ request()->status == 'received' ? 'selected' : '' }}>{{ trans('backend.received') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="category_id"><b>{{ trans('backend.search') }}</b></label> <br>
                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i> {{ trans('backend.search') }}</button>
                    </div>
                </div>
            </form>
            <br><br><br><br><br>
            <br><br><br><br><br><br>
            <hr style="border-width:2px;border-color:#ccc">

            <div class="">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.image') }}</b></th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.product_category') }}</b></th>
                            <th><b>{{ trans('backend.brand') }}</b></th>
                            <th><b>{{ trans('backend.warehouse') }}</b></th>
                            <th><b>{{ trans('backend.price') }}</b></th>
                            <th><b>{{ trans('backend.quantity') }}</b></th>
                            <th><b>{{ trans('backend.status') }}</b></th>
                            <th><b>{{ trans('backend.active') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if( $products->count() > 0 )
                            @foreach( $products as $index=>$product )
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img style="width:50px;height:50px;object-fit:contain" src="{{ asset($product->image) }}" alt="">
                                    </td>
                                    <td>
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->name_en }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->product_category->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->product_category->name_en }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->brand->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->brand->name_en }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( app()->getLocale() == 'ar' )
                                            {{  $product->warehouse->name_ar }}
                                        @elseif( app()->getLocale() == 'en' )
                                            {{  $product->warehouse->name_en }}
                                        @endif
                                    </td>
                                    <td>{{ number_format($product->price,2) }}</td>
                                    <td>
                                        <span class="label label-info">{{ $product->quantity }}</span>
                                    </td>
                                    <td>
                                        @if( $product->status == 'pending' )
                                            <span class="badge label-warning">{{ trans('backend.pending') }}</span>
                                        @elseif( $product->status == 'received' )
                                            <span class="badge label-primary">{{ trans('backend.received') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $product->active == 1 )
                                            <span class="badge label-success">{{ trans('backend.active') }}</span>
                                        @else
                                            <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="btn-group manage-button" title="View Account">
                                            <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="fa fa-cog"></i> <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu dropdown-light pull-right">

                                                @if( $product->active == 0 )
                                                    <li>
                                                        <a title="{{ trans('backend.activation') }} {{ trans('backend.record') }}" href="{{ route('admin.products.activation' , $product->id) }}">
                                                            <i class="fa fa-fw fa-check"></i> {{ trans('backend.activation') }}
                                                        </a>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a title="{{ trans('backend.disable') }} {{ trans('backend.record') }}" href="{{ route('admin.products.activation' , $product->id) }}">
                                                            <i class="fa fa-fw fa-close"></i> {{ trans('backend.disable') }}
                                                        </a>
                                                    </li>
                                                @endif
                                                

                                                <li>
                                                    <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.products.show' , $product->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.products.edit' , $product->id) }}">
                                                        <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <form action="{{ route('admin.products.destroy' , $product->id) }}" method="POST" style="display:inline">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" type="submit"  class="delete" style="cursor:pointer">
                                                            <i class="fa fa-trash fa-fw"></i> {{ trans('backend.delete') }}
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="12">
                                    <h4 style="color:tomato"><strong>{{ trans('backend.no_data') }}</strong></h4>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $products->appends($_GET)->links() }}
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection


@push('scripts')
    <script>
        $(document).ready(function(){
            
            // var table = $('#yajra-datatable').DataTable();

            $(document).on('change' , '#order' , function(e){
                e.preventDefault();
                $('#searchForm').submit();
            });

        });
    </script>
@endpush