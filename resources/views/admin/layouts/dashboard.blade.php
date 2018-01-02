@extends('admin.layouts.app')

@section('body')
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('/') }}">{{ config('app.name') }}</a>
            </div>
            <!-- /.navbar-header -->
            
            {{-- contact message dropdown --}}
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ route('teamprofile.myprofile', ['tp' => Auth::id()]) }}"><i class="fa fa-user fa-fw"></i> My Profile</a>
                        </li>
                        @can('super-admin')
                            <li>
                                <a href="{{ route('setting.index') }}"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                        @endcan
                        <li class="divider"></li>
                        <li>
                        <form action="{{ route('logout') }}" method="post">
                        {{csrf_field()}}
                            <button type="submit" class="form-control"> 
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </button>
                        </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('admin') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="#">
                                <i class="fa fa-picture-o fa-fw"></i> Images<span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*image') ? 'class="active"' : '') }}>
                                    <a href="{{ route ('image.index') }}">Library</a>
                                </li>
                                <li>
                                    <a href="{{ route ('image.create') }}">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    
                        <li>
                            <a href="#"><i class="fa fa-thumb-tack fa-fw"></i> Blogs<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*blog') ? 'class="active"' : '') }}>
                                    <a href="{{ route('blog.index') }}">All Posts</a>
                                </li>
                                <li {{ (Request::is('*blog/create') ? 'class="active"' : '') }}>
                                    <a href="{{ route ('blog.create') }}">Add New</a>
                                </li>
                                <li {{ (Request::is('*category') ? 'class="active"' : '') }}>
                                    <a href="{{ route ('category.index') }}">Categories</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-briefcase fa-fw"></i> Portfolios <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*portfolio') ? "class='active'" : "") }}>
                                    <a href="{{ route('portfolio.index') }}">All Portfolios</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-shopping-bag fa-fw"></i> Products<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*product') ? 'class="active"' : '') }}>
                                    <a href="{{ route('product.index') }}">All Products</a>
                                </li>
                                <li {{ (Request::is('*product/create') ? 'class="active"' : '') }}>
                                    <a href="{{ route('product.create') }}">Add New</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href=""><i class="fa fa-user fa-fw"></i> Team Profiles<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li {{ (Request::is('*teamprofile') ? 'class="active"' : '') }}>
                                    <a href="{{ route('teamprofile.index') }}">All Profiles</a>
                                </li>
                            </ul>
                        </li>

                        @can('super-admin')
    
                        <li>
                            <a href="#">
                                <i class="fa fa-cogs fa-fw"></i> Setting<span class="fa arrow"></span>
                            </a>
                            <ul class="nav nav-second-level">
                                <li {{ (Request::is('*setting') ? 'class="active"' : '') }}>
                                    <a href="{{ route('setting.index') }}"><i class="fa fa-cog fa-fw"></i>General</a>
                                </li>
                            </ul>
                                
                        </li>

                        @endcan

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">@yield('page_heading')</h3>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection
