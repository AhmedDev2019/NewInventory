<header class="main-header">

    <!-- Logo -->
    <a href="" class="logo">
      <span class="logo-mini"><b>CP</b></span>
      <span class="logo-lg"><b>{{ trans('backend.control_panel') }}</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
       
        <ul class="nav navbar-nav">
          <!-- <li class="text-center hidden-xs" id="">
            <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search Sales Invoice">
            </div>
          </form> 
          </li> -->
          <!-- User Account Menu -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown" title="App Language" data-toggle='tooltip'>
              <i class="fa fa-globe fa-lg"></i> &nbsp;
              {{ trans('backend.language') }}
            </a>
            <ul class="dropdown-menu" style="width: auto;height: auto;">
              <li>
                <ul class="menu languages">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach          
                </ul>
              </li>
             
            </ul>
          </li>
          
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o fa-fw fa-lg"></i>
              <span class="label label-danger">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header"><b>{{ trans('backend.you_have_notifications') }}</b> &nbsp; - <b style="color:tomato;font-size:18px">4</b></li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{ asset('Dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="{{ asset('Dashboard/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">{{ trans('backend.show_all_notifications') }}</a></li>
            </ul>
          </li>

          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset(adminurl()->avatar) }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ adminurl()->first_name }} {{ adminurl()->last_name }}</span>
            </a>

            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ asset(adminurl()->avatar) }}" class="img-circle" alt="User Image">
                <p>
                 {{ adminurl()->first_name }} {{ adminurl()->last_name }} <small>{{ trans('backend.year') }} 2022</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="row">
                  <div class="col-md-12">
                    <div class="">
                      <a href="{{ route('admin.profile') }}" style="margin-bottom:10px" class="btn btn-default btn-block "> <i class="fa fa-user fa-fw"></i> {{ trans('backend.profile') }}</a>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="">
                      <a target="_blank" href="{{ url('/') }}" style="margin-bottom:10px" class="btn btn-default btn-block "> <i class="fa fa-eye fa-fw"></i> {{ trans('backend.visit_website') }}</a>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="">
                      <form action="{{ route('admin.logout') }}" method="POST">
                          @csrf
                          <button type="submit" style="cursor:pointer" class="btn btn-default btn-block confirm_logout"><i class="fa fa-power-off fa-fw"></i> {{ trans('backend.logout') }}</button>
                      </form>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>

    </nav>
  </header>