@php
    $segment = Request::segment(3);
    $route = Route::currentRouteName();
@endphp
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left">
          <img src="{{ asset(adminurl()->avatar) }}" style="width:40px;height:40px;border-radius:50%" class="" alt="User Image">
        </div>
        <div class="pull-left info" style="margin-top:10px">
          <p> {{ adminurl()->first_name }} {{ adminurl()->last_name }}</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <!--<li class="header">MAIN NAVIGATION</li>-->
        <li class="{{ $route == 'admin.index' ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard text-aqua"></i> <span> {{ trans('backend.dashboard') }}</span></a>
        </li>
      
        <!-- Admins -->
        <li class="{{ $segment == 'admins' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
            <a href="users.html">
                <i class="fa fa-user-plus"></i> <span>{{ trans('backend.admins') }}</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ $route == 'admin.admins.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.admins.index') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.admins') }}</span>
                    </a>
                </li>
                <li class="{{ $route == 'admin.admins.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.admins.create') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.create_new') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Brands -->
        <li class="{{ $segment == 'brands' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
            <a href="users.html">
                <i class="fa fa-bookmark"></i> <span>{{ trans('backend.brands') }}</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ $route == 'admin.brands.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.brands.index') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.brands') }}</span>
                    </a>
                </li>
                <li class="{{ $route == 'admin.brands.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.brands.create') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.create_new') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Warehouses -->
        <li class="{{ $segment == 'warehouses' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
            <a href="users.html">
                <i class="fa fa-warehouse"></i> <span>{{ trans('backend.warehouses') }}</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ $route == 'admin.warehouses.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.warehouses.index') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.warehouses') }}</span>
                    </a>
                </li>
                <li class="{{ $route == 'admin.warehouses.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.warehouses.create') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.create_new') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Suppliers -->
        <li class="{{ $segment == 'suppliers' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
            <a href="users.html">
                <i class="fa fa-user"></i> <span>{{ trans('backend.suppliers') }}</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ $route == 'admin.suppliers.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.suppliers.index') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.suppliers') }}</span>
                    </a>
                </li>
                <li class="{{ $route == 'admin.suppliers.create' ? 'active' : '' }}">
                    <a href="{{ route('admin.suppliers.create') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.create_new') }}</span>
                    </a>
                </li>
            </ul>
        </li>

    

        <!-- Settings -->
        <!-- <li class="{{ $segment == 'settings' ? 'active' : '' }} users-active-li roles-list-active-li role-active-li treeview">
            <a href="users.html">
                <i class="fa fa-cogs"></i> <span>{{ trans('backend.settings') }}</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{{ $route == 'admin.settings.index' ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fa fa-angle-double-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
                        <span>{{ trans('backend.settings') }}</span>
                    </a>
                </li>
                
            </ul>
        </li> -->
        
           
                
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>