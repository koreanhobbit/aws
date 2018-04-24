@extends('layouts.master')
@section('siteName', $settings->first()->site_title)

@foreach($settings as $setting)
    @if(count($setting->images))
        @foreach($setting->images as $item)
            @if($item->pivot->is_maskot == 0)     
                @section('siteIcon', asset($item->thumbnail->location))
            @endif
        @endforeach
    @endif
@endforeach


@section('tagline', $settings->first()->tagline)
@section('content')
	<!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">We put our heart in delivering our best services to our customers.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-desktop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Website Design &amp; Development</h4>
                    <p class="text-muted">We provide website design and development for all purposes. Personal website, company profile, e-commerce, start-up company, group community and others.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-mobile fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">App Design &amp; Development</h4>
                    <p class="text-muted">We provide app design and development for all purposes from your start-up companies until established enterprises.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-bank fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Business Consulting</h4>
                    <p class="text-muted">We will help you to build up your business and start-up company by providing the best solutions for you.</p>
                </div>
            </div>
        </div>
    </section>

    <div id="portfolios_container">
        @include('partials._portfolio')
    </div>
    
    <div class="product_container">
        @include('partials._product')
    </div>

    <div id="blogscontainer">
        @include('partials._blog')
	</div>

	<!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">About</h2>
                    <h3 class="section-subheading text-muted">Start small, dream big.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="timeline">
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="{{ asset('img/about/1.jpg') }}" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>2014</h4>
                                    <h4 class="subheading">It began with a dream</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">Like any other things in this world, our company started from a simple dream to provide best services in online business and start-up company to all people</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="{{ asset('img/about/2.jpg') }}" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>September 2015</h4>
                                    <h4 class="subheading">A Company was born</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">With entrepreneurship spirit we built our company and started from people around us.</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="timeline-image">
                                <img class="img-circle img-responsive" src="{{ asset('img/about/3.jpg') }}" alt="">
                            </div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4>July 2016</h4>
                                    <h4 class="subheading">The beginning of full services</h4>
                                </div>
                                <div class="timeline-body">
                                    <p class="text-muted">We are providing full profesional services to all of our customers</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-inverted">
                            <div class="timeline-image">
                                <h4>We Are
                                    <br>Here for
                                    <br>You!</h4>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="team_member_container">
        @include('partials._team_member')
    </div>

	<!-- Clients Aside -->
    <aside class="clients">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="http://www.laravel.com" target="_blank">
                        <img src="{{ asset('img/logos/laravel.png') }}" class="img-responsive img-centered" alt="" style="width: 250px; height: 50px;">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="http://www.codeigniter.com" target="_blank">
                        <img src="{{ asset('img/logos/codeigniter.png') }}" class="img-responsive img-centered" alt="" style="width: 250px; height: 50px;">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="http://www.wordpress.com" target="_blank">
                        <img src="{{ asset('img/logos/wordpress.png') }}" class="img-responsive img-centered" alt="" style="width: 250px; height: 50px;">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="http://www.digitalocean.com" target="_blank">
                        <img src="{{ asset('img/logos/digitalocean.png') }}" class="img-responsive img-centered" alt="" style="width: 250px; height: 50px;">
                    </a>
                </div>
            </div>
        </div>
    </aside>
	
	<div class="contact_container">
        @include('partials._contact')
    </div>

    {{-- footer section --}}
    <footer class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; @yield('siteName') {{ date("Y") }}</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        @foreach($settings->first()->websitesocialmedias as $item)
                            <li><a href="{{ $item->link }}" target="_blank" title="{{ ucfirst($item->name) }}"><i class="fa fa-{{ $item->icon }}"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="privacy_policy" data-toggle="modal" data-target="#modalPrivacy">Privacy Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
@endsection 

@section('modals')
    @include('partials.modals._privacy_modal')
    @include('partials.modals._team_member_modal')
@endsection

@section('script')
    @include('partials._script')
@endsection

