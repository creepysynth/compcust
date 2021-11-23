<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
        <ol class="breadcrumb p-2 mb-0" style="background: inherit">
          @yield('breadcrumbs')
        </ol>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
{{--      <li class="nav-item">--}}
{{--        <a class="nav-link" data-widget="navbar-search" href="#" role="button">--}}
{{--          <i class="fas fa-search"></i>--}}
{{--        </a>--}}
{{--        <div class="navbar-search-block">--}}
{{--          <form class="form-inline">--}}
{{--            <div class="input-group input-group-sm">--}}
{{--              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--              <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                  <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--                <button class="btn btn-navbar" type="button" data-widget="navbar-search">--}}
{{--                  <i class="fas fa-times"></i>--}}
{{--                </button>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </form>--}}
{{--        </div>--}}
{{--      </li>--}}

      <li class="nav-item dropdown user-menu">
        <div class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="{{ json_decode(request()->cookie('user'))->image }}" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline">{{ json_decode(request()->cookie('user'))->name }}</span>
        </div>
      </li>
      <li class="nav-item dropdown user-menu">
        <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm mt-1">Sign Out <i class="fas fa-sign-out-alt ml-1"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link mb-3">
      <img src="{{ asset('images/img.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('companies.index') }}" class="nav-link {{ request()->route()->named('companies.*') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-industry"></i>
              <p>
                Companies
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('customers.index') }}" class="nav-link {{ request()->route()->named('customers.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Customers
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content pt-3">
      @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> {{ session()->get('message') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @yield('content')
    </section>
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
