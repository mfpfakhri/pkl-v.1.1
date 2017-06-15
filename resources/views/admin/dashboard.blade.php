@extends('layouts.side')

@section('title', 'Dashboard Admin')

@section('content')

<!-- Begin page -->
<div id="wrapper">

  <!-- Top Bar Start -->
  <div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="#" class="logo"><span>NEKA<span>NEKA</span></span><i class="zmdi zmdi-layers"></i></a>
    </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">

                <!-- Page title -->
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <button class="button-menu-mobile open-left">
                            <i class="zmdi zmdi-menu"></i>
                        </button>
                    </li>
                    <li>
                        <h4 class="page-title">Dashboard</h4>
                    </li>
                </ul>

            </div><!-- end container -->
        </div><!-- end navbar -->
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">

            <!-- User -->
            <div class="user-box">
                <h5><a href="#">Admin</a> </h5>
                <ul class="list-inline">
                    <li>
                        <a href="/" class="text-custom">
                            <i class="zmdi zmdi-home"></i>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/logout') }}" class="text-custom"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                            <i class="zmdi zmdi-power"></i>
                        </a>
                    </li>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                    {{ csrf_field() }}
                    </form>
                </ul>
            </div>
            <!-- End User -->

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul>
                  <li class="text-muted menu-title">Navigation</li>

                    <li>
                        <a href="/dash" class="waves-effect active"><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>

                    <li>
                        <a href="/dash/products" class="waves-effect"><i class="zmdi zmdi-cloud-box"></i> <span> Products </span> </a>
                    </li>

                    <li>
                        <a href="/dash/agents" class="waves-effect"><i class="zmdi zmdi-account-box"></i> <span> Agents </span> </a>

                    <li>
                        <a href="/dash/customers" class="waves-effect"><i class="zmdi zmdi-account-box-o"></i><span> Customers </span> </a>

                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- Sidebar -->
            <div class="clearfix"></div>

        </div>

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">

                    <div class="col-lg-4 col-md-6">
                    <div class="card-box">

                      <h4 class="header-title m-t-0 m-b-30">Total Product</h4>

                            <div class="widget-chart-1">
                                <div class="widget-detail-1">
                                    <h2 class="p-t-10 m-b-0">
                                      <?php
                                        echo $countproduct;
                                      ?>
                                    </h2>
                                    <p class="text-muted">Unit</p>
                                </div>
                            </div>
                    </div>
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6">
                    <div class="card-box">

                      <h4 class="header-title m-t-0 m-b-30">Total Agent</h4>

                            <div class="widget-chart-1">
                                <div class="widget-detail-1">
                                    <h2 class="p-t-10 m-b-0">
                                       <?php
                                          echo $countagent;
                                       ?>
                                    </h2>
                                    <p class="text-muted">Agent</p>
                                </div>
                            </div>
                    </div>
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-6">
                    <div class="card-box">

                      <h4 class="header-title m-t-0 m-b-30">Total Customer</h4>

                            <div class="widget-chart-1">
                                <div class="widget-detail-1">
                                    <h2 class="p-t-10 m-b-0">
                                      <?php
                                        echo $countcustomer;
                                      ?>
                                    </h2>
                                    <p class="text-muted">Customer</p>
                                </div>
                            </div>
                    </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2016 © NEKANEKA.
        </footer>

    </div>

</div>
<!-- END wrapper -->

@stop
