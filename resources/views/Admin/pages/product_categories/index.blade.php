@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-bookmark"></i> {{ trans('backend.product_categories') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                {{ trans('backend.info') }} {{ trans('backend.product_categories') }}
            </h3>
            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('admin.product_categories.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> {{ trans('backend.create_new') }}</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <!-- Search Form  -->
            <form id="searchForm" action="{{ route('admin.product_categories.index') }}" method="GET">
                <div class="">
                    <div class="col-md-6">
                        <label for="search"><b>{{ trans('backend.search') }}</b></label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="{{ trans('backend.search') }}" value="{{ request()->search }}">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="order"><b>{{ trans('backend.order') }}</b></label>
                            <select name="order" id="order" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                <option value="desc" {{ request()->order == 'desc' ? 'selected' : '' }}>{{ trans('backend.latest') }}</option>
                                <option value="asc" {{ request()->order == 'asc' ? 'selected' : '' }}>{{ trans('backend.oldest') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="category_id"><b>{{ trans('backend.search') }}</b></label> <br>
                        <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i> {{ trans('backend.search') }}</button>
                    </div>
                </div>
            </form>
            <br><br><br><br><br>
            <hr style="border-width:2px;border-color:#ccc">

            <div class="">
                <table id="yajra-datatable" class="table table-hover table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><b>{{ trans('backend.image') }}</b></th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.status') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $product_categories as $index=>$product_category )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img style="width:50px;height:50px;object-fit:contain" src="{{ asset($product_category->icon) }}" alt="">
                                </td>
                                <td>
                                    @if( app()->getLocale() == 'ar' )
                                        {{  $product_category->name_ar }}
                                    @elseif( app()->getLocale() == 'en' )
                                        {{  $product_category->name_en }}
                                    @endif
                                </td>
                                <td>
                                    @if( $product_category->status == 1 )
                                        <span class="badge label-success">{{ trans('backend.active') }}</span>
                                    @else
                                        <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $product_category->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">

                                            @if( $product_category->status == 0 )
                                                <li>
                                                    <a title="{{ trans('backend.activation') }} {{ trans('backend.record') }}" href="{{ route('admin.product_categories.activation' , $product_category->id) }}">
                                                        <i class="fa fa-fw fa-check"></i> {{ trans('backend.activation') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a title="{{ trans('backend.disable') }} {{ trans('backend.record') }}" href="{{ route('admin.product_categories.activation' , $product_category->id) }}">
                                                        <i class="fa fa-fw fa-close"></i> {{ trans('backend.disable') }}
                                                    </a>
                                                </li>
                                            @endif
                                            
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.product_categories.edit' , $product_category->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <form action="{{ route('admin.product_categories.destroy' , $product_category->id) }}" method="POST" style="display:inline">
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
                    </tbody>
                </table>
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