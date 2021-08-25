<!DOCTYPE html>
<html lang="en">
<head>
  <script>
    var BASE_URL="{{ url('') }}";
  </script>
  <meta charset="utf-8">
  <meta name="referrer" content="no-referrer" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ get_setting('site_title') }} | @yield('title')</title>
  <link rel="icon" href="{{ url(get_setting('fevicon')) }}" type="image/gif" sizes="16x16">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ url('') }}/public/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('') }}/public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="{{ url('') }}/public/assets/css/toastr.min.css">
  <link rel="stylesheet" href="{{ url('') }}/public/assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('') }}/public/assets/tags/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="{{ url('') }}/public/assets/select2/select2.min.css">
  <link rel="stylesheet" href="{{ url('') }}/public/assets/css/jquery.mCustomScrollbar.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('') }}/public/assets/dist/css/adminlte.css">
  
<script src="{{ url('') }}/public/assets/ckeditor/ckeditor.js"></script>  
<script src="{{ url('') }}/public/assets/embed/plugin.js"></script>  
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
{{ csrf_field() }}
<input type="hidden" value="{{ route('upload', ['_token' => csrf_token() ]) }}" id="ck_url" />
<div class="ovrl hide_div" id="page_overlay" style="
    position: absolute;
    width: 100%;
    height: 100%;
    background: #ffffffb0;
    z-index: 1;
"></div>
<div id="loader1" class="hide_div" style="z-index: 7;position: absolute;top: 50%;left: 43%;">
<img src="{{ url('public/assets/images/ajax-loader.gif') }}" >
</div>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-cog"></i>
        </a>
        <div class="dropdown-menu  dropdown-menu-right">
          <a href="{{ url('admin/profile') }}" class="dropdown-item">
            <i class="fa fa-user mr-2"></i> Profile
          </a>
          <a href="{{ url('admin/logout') }}" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('') }}" class="brand-link text-center">
      <span class="brand-text font-weight-light">{{ get_setting('site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{ Session::get('admin_session')->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <?php 
      $session_info=Session::get('admin_session');
      $user_access=json_decode(json_encode(json_decode(get_user_access($session_info->role)->permission)),true);
      ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('admin/dashboard') }}" class="nav-link <?php if(Request::segment(2)=='dashboard') { echo "active"; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(array_key_exists('manage_user',$user_access))
          <li class="nav-item has-treeview <?php if(Request::segment(2)=='users') { echo 'menu-open'; } ?>">
          <!-- classes   active  menu-open-->
            <a href="javascript:;" class="nav-link <?php if(Request::segment(2)=='users') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{  url('admin/users/role_manage') }}" class="nav-link <?php if(Request::segment(3)=='role_manage') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Role manage</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/users/user_manage') }}" class="nav-link <?php if(Request::segment(3)=='user_manage') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Users</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(array_key_exists('news',$user_access))	  
		  <li class="nav-item has-treeview <?php if(Request::segment(2)=='blogcategory' || Request::segment(2)=='blog' || Request::segment(2)=='blog_comment') { echo 'menu-open'; } ?>">
          <!-- classes   active  menu-open-->
            <a href="javascript:;" class="nav-link <?php if(Request::segment(2)=='blogcategory' || Request::segment(2)=='blog' || Request::segment(2)=='blog_comment') { echo 'active'; } ?>">
              <i class="nav-icon fas fa-rss"></i>
              <p>
              Blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('admin/blogcategory') }}" class="nav-link <?php if(Request::segment(2)=='blogcategory') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Blog Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/blog') }}" class="nav-link <?php if(Request::segment(2)=='blog') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Blog</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{  url('admin/blog_comment') }}" class="nav-link <?php if(Request::segment(2)=='blog_comment') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blog Comment</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
		  @if(array_key_exists('crimsonbride',$user_access))
		  <li class="nav-item">
            <a href="{{ url('admin/crimsonbride') }}" class="nav-link <?php if(Request::segment(2)=='crimsonbride' || Request::segment(2)=='add_new_crimsonbride' || Request::segment(2)=='edit_crimsonbride') { echo "active"; } ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
               Crimson Bride
              </p>
            </a>
          </li>
		  @endif
		  @if(array_key_exists('landingpage',$user_access))
		  <li class="nav-item">
            <a href="{{ url('admin/landing-page') }}" class="nav-link <?php if(Request::segment(2)=='landing-page' || Request::segment(2)=='add-landing-page' || Request::segment(2)=='edit-landing-page') { echo "active"; } ?>">
              <i class="mr-2 ml-2 fas fa-file-powerpoint"></i> 
              <p>
               Landing Pages
              </p>
            </a>
          </li>
		  @endif
          @if(array_key_exists('tarasri_exclusive',$user_access))
          <li class="nav-item">
            <a href="{{ url('admin/tarasri_exclusive') }}" class="nav-link <?php if(Request::segment(2)=='tarasri_exclusive') { echo "active"; } ?>">
              <i class="nav-icon fa fa-star"></i>
              <p>
              Tarasri Exclusive
              </p>
            </a>
          </li>
          @endif
          @if(array_key_exists('products',$user_access))
          <li class="nav-item has-treeview <?php if(Request::segment(2)=='products' && Request::segment(3)!='manage_product' && Request::segment(3)!='edit_product' && Request::segment(3)!='add_new_product') { echo 'menu-open'; } ?>">
          <!-- classes   active  menu-open-->
            <a href="javascript:;" class="nav-link <?php if(Request::segment(2)=='products' && Request::segment(3)!='manage_product' && Request::segment(3)!='edit_product' && Request::segment(3)!='add_new_product') { echo 'active'; } ?>">
              <i class="nav-icon fa fa-archive"></i>
              <p>
              Products Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{  url('admin/products/category') }}" class="nav-link <?php if(Request::segment(3)=='category') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/collections') }}" class="nav-link <?php if(Request::segment(3)=='collections') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collections</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/occasion') }}" class="nav-link <?php if(Request::segment(3)=='occasion') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Occasion</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/design_style') }}" class="nav-link <?php if(Request::segment(3)=='design_style') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Design Style</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/metal') }}" class="nav-link <?php if(Request::segment(3)=='metal') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Metal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/purity') }}" class="nav-link <?php if(Request::segment(3)=='purity') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purity</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/gemstone') }}" class="nav-link <?php if(Request::segment(3)=='gemstone') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gemstone</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/products/diamond_type') }}" class="nav-link <?php if(Request::segment(3)=='diamond_type') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Diamond Type</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{  url('admin/products/manage_product') }}" class="nav-link <?php if(Request::segment(3)=='manage_product' || Request::segment(3)=='add_new_product' || Request::segment(3)=='edit_product') { echo "active"; } ?>">
              <i class="nav-icon fa fa-th"></i>
              <p>
              Manage Product
              </p>
            </a>
          </li>
          @endif
          @if(array_key_exists('enquiry',$user_access))
          <li class="nav-item">
            <a href="{{ url('admin/enquiry') }}" class="nav-link <?php if(Request::segment(2)=='enquiry') { echo "active"; } ?>">
              <i class="nav-icon fa fa-info-circle"></i>
              <p>
              Enquiry
              </p>
            </a>
          </li>
          @endif
		  @if(array_key_exists('testimonial',$user_access))
		  <li class="nav-item">
            <a href="{{ url('admin/testimonial') }}" class="nav-link <?php if(Request::segment(2)=='testimonial') { echo "active"; } ?>">
              <i class="nav-icon fa fa-users"></i>
              <p>
              Testimonial
              </p>
            </a>
          </li>
		  @endif
          @if(array_key_exists('contact_us',$user_access))
          <li class="nav-item">
            <a href="{{ url('admin/contactus') }}" class="nav-link <?php if(Request::segment(2)=='contactus') { echo "active"; } ?>">
              <i class="nav-icon fa fa-comments"></i>
              <p>
              Contact Us
              </p>
            </a>
          </li>
          @endif
          @if(array_key_exists('setting',$user_access))
          <li class="nav-item has-treeview <?php if(Request::segment(2)=='setting') { echo 'menu-open'; } ?>">
          <!-- classes   active  menu-open-->
            <a href="javascript:;" class="nav-link <?php if(Request::segment(2)=='setting') { echo 'active'; } ?>">
              <i class="nav-icon fa fa-cog"></i>
              <p>
              Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{  url('admin/setting/general_settings') }}" class="nav-link <?php if(Request::segment(3)=='general_settings') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Settings</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/setting/home_page') }}" class="nav-link <?php if(Request::segment(3)=='home_page') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/setting/aboutUs') }}" class="nav-link <?php if(Request::segment(3)=='aboutUs') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About US</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="{{  url('admin/setting/our_partners') }}" class="nav-link <?php if(Request::segment(3)=='our_partners') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Our Partners</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/setting/privacypolicy') }}" class="nav-link <?php if(Request::segment(3)=='privacypolicy') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Privacy Policy</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{  url('admin/setting/term_and_condition') }}" class="nav-link <?php if(Request::segment(3)=='term_and_condition') { echo 'active'; } ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Term and Condition</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right"> 
              <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
              <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y') }} <a href="{{ url('') }}">{{ get_setting('site_title') }}</a>.</strong>
    All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ url('') }}/public/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ url('') }}/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ url('') }}/public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('') }}/public/assets/dist/js/adminlte.js"></script>
<script src="{{ url('') }}/public/assets/select2/select2.full.min.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="{{ url('') }}/public/assets/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ url('') }}/public/assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ url('') }}/public/assets/plugins/raphael/raphael.min.js"></script>
<script src="{{ url('') }}/public/assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ url('') }}/public/assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('') }}/public/assets/plugins/chart.js/Chart.min.js"></script>
<script src="{{ url('') }}/public/assets/js/toastr.min.js"></script>
<script src="{{ url('') }}/public/assets/js/jquery.dataTables.min.js"></script>
<script src="{{ url('') }}/public/assets/js/dataTables.bootstrap4.min.js"></script> 
<script src="{{ url('') }}/public/assets/js/jquery.mCustomScrollbar.min.js"></script>  
<!-- PAGE SCRIPTS -->
<script src="{{ url('') }}/public/assets/js/custom.js"></script>
</body>
</html>