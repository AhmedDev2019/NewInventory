@extends('Admin.layouts.master')

@section('pageTitle') <i class="fa fa-user"></i> {{ trans('backend.suppliers') }} @endsection

@section('content')

    <div class="box">

        <div class="box-header with-border">
            <h3 class="box-title">
                {{ trans('backend.info') }} {{ trans('backend.suppliers') }}
            </h3>

            <div class="button-page-header">
                <a class="btn btn-block btn-primary" href="{{ route('admin.suppliers.create') }}">
                <i class="fa fa-plus-circle fa-fw fa-lg"></i> {{ trans('backend.create_new') }}</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <!-- Search Form  -->
            <form id="searchForm" action="{{ route('admin.suppliers.index') }}" method="GET">
                <div class="">
                    <div class="col-md-6">
                        <label for="search"><b>{{ trans('backend.search') }}</b></label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="{{ trans('backend.search') }}" value="{{ request()->search }}">
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="supplier_type"><b>{{ trans('backend.supplier_type') }}</b></label>
                            <select name="supplier_type" id="supplier_type" class="form-control select2" style="width:100%">
                                <option value="">...........</option>
                                <option value="person" {{ request()->supplier_type == 'person' ? 'selected' : '' }}>{{ trans('backend.person') }}</option>
                                <option value="company" {{ request()->supplier_type == 'company' ? 'selected' : '' }}>{{ trans('backend.company') }}</option>
                            </select>
                        </div>
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
                    <div class="col-md-2">
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
                            <th><b>{{ trans('backend.logo') }}</b></th>
                            <th><b>{{ trans('backend.name') }}</b></th>
                            <th><b>{{ trans('backend.supplier_type') }}</b></th>
                            <th><b>{{ trans('backend.email') }}</b></th>
                            <th><b>{{ trans('backend.phone') }} 1</b></th>
                            <th><b>{{ trans('backend.address') }}</b></th>
                            <th><b>{{ trans('backend.status') }}</b></th>
                            <th><b>{{ trans('backend.date') }}</b></th>
                            <th width="8%"><b>{{ trans('backend.manage') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $suppliers as $index=>$supplier )
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img style="width:50px;height:50px;object-fit:contain" src="{{ asset($supplier->logo) }}" alt="">
                                </td>
                                <td>{{ $supplier->name }}</td>
                                <td>
                                    @if( $supplier->supplier_type == 'person' )
                                        <p class="label label-warning">{{ trans('backend.person') }}</p>
                                    @elseif( $supplier->supplier_type == 'company' )
                                        <p class="label label-warning">{{ trans('backend.company') }}</p>
                                    @endif
                                </td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>
                                    @if( $supplier->status == 1 )
                                        <span class="badge label-success">{{ trans('backend.active') }}</span>
                                    @else
                                        <span class="badge label-danger">{{ trans('backend.inactive') }}</span>
                                    @endif
                                </td>
                                <td>{{ $supplier->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group manage-button" title="View Account">
                                        <a class="btn btn-primary btn-o dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i> <span class="caret"></span>
                                        </a>
                                        <ul role="menu" class="dropdown-menu dropdown-light pull-right">

                                            @if( $supplier->status == 0 )
                                                <li>
                                                    <a title="{{ trans('backend.activation') }} {{ trans('backend.record') }}" href="{{ route('admin.suppliers.activation' , $supplier->id) }}">
                                                        <i class="fa fa-fw fa-check"></i> {{ trans('backend.activation') }}
                                                    </a>
                                                </li>
                                            @else
                                                <li>
                                                    <a title="{{ trans('backend.disable') }} {{ trans('backend.record') }}" href="{{ route('admin.suppliers.activation' , $supplier->id) }}">
                                                        <i class="fa fa-fw fa-close"></i> {{ trans('backend.disable') }}
                                                    </a>
                                                </li>
                                            @endif
                                            

                                            <li>
                                                <a title="{{ trans('backend.show') }} {{ trans('backend.record') }}" href="{{ route('admin.suppliers.show' , $supplier->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> {{ trans('backend.show') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <a title="{{ trans('backend.edit') }} {{ trans('backend.record') }}" href="{{ route('admin.suppliers.edit' , $supplier->id) }}">
                                                    <i class="fa fa-fw fa-pencil"></i> {{ trans('backend.edit') }}
                                                </a>
                                            </li>
                                            
                                            <li>
                                                <form action="{{ route('admin.suppliers.destroy' , $supplier->id) }}" method="POST" style="display:inline">
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