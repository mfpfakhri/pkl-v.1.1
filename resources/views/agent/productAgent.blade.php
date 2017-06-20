@extends('layouts.side')

@section('title', 'Product Agent')

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
                        <h4 class="page-title">Product</h4>
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
                <h5><a href="#">Agent</a> </h5>
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
                        <a href="{{ url('/dashboardagent') }}" class="waves-effect "><i class="zmdi zmdi-view-dashboard"></i> <span> Dashboard </span> </a>
                    </li>
                    <li>
                        <a href="{{ url('/productagent') }}" class="waves-effect active"><i class="zmdi zmdi-cloud-box"></i> <span> Product </span> </a>
                    </li>
                    <li>
                        <a href="{{ url('/bookingagent') }}" class="waves-effect"><i class="zmdi zmdi-email-open"></i> <span> Booking </span> </a>
                    </li>
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
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="m-b-30">
                                            <a href="{{ url('/productcreate') }}" class="btn btn-primary waves-effect waves-light">Add Product <i class="fa fa-plus"></i></a>
                                            <a href="{{ url('/productagent') }}" class="btn btn-primary waves-effect waves-light">List Product <i class="fa fa-list"></i></a>
                                        </div>
                                        @if(session('warning'))
                                            {{session('warning')}}
                                        @endif
                                    </div>
                                </div>

                                <div class="">
                                    <table class="table table-striped" id="datatable-editable">
                                        <thead>
                                           <tr>
                                                <th>ID</th>
                                                <th>Judul</th>
                                                <th>Harga</th>
                                                <th>Peserta</th>
                                                <th>Jadwal</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX">
                                            @foreach($query as $product)
                                                <td>{{$product->paket_id}}</td>
                                                <td>{{$product->paket_judul}}</td>
                                                <td>Rp. {{$product->paket_harga}} /pax</td>
                                                <th>{{$product->schedule_jadwal_start}} s/d {{$product->schedule_jadwal_end}}</th>
                                                <td>{{$product->schedule_max_people}}</td>
                                                <td class="actions">
                                                    <a onclick="" href="/product/{{$product->id}}/edit" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                                    <a onclick="" href="productdelete/{{$product->id}}" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end: panel body -->

                        </div> <!-- end panel -->
                    </div> <!-- end col-->
                </div><!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right">
            2016 © NEKANEKA.
        </footer>

    </div>
</div>
<!-- END wrapper -->

@stop