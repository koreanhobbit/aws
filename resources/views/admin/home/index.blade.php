@extends('admin.layouts.dashboard')

@section('page_heading','Dashboard')

@section('section')
{{ csrf_field() }}
    <!-- /.row -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-envelope fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $messagesCount->count() }}</div>
                                <div>Contact Messages</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:" class="message_details" data-url="{{ route('dashboard.messages') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-thumb-tack fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $blogCount }}</div>
                                <div>Blog</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('blog.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-briefcase fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $portfolioCount }}</div>
                                <div>Portfolio</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('portfolio.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $memberCount }}</div>
                                <div>Team Members!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('teamprofile.index') }}">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        @if(session('message'))
            <div class="alert alert-success message">
                <h4>{{ session('message') }}</h4>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-12">
                @component('admin.widgets.panel')
                    @slot('panelTitle', 'Responsive Timeline')
                    @slot('panelBody')
                        <div class="timeline_container">
                           @include('admin.home.partials._timeline')
                        </div>
                    @endslot
                @endcomponent
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.col-sm-12 -->
@endsection
@include('admin.home.partials._script')