<!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Portfolio</h2>
                <h3 class="section-subheading text-muted">Here are some our sample projects.</h3>
            </div>
        </div>
        <div class="row">
            @foreach($portfolios as $portfolio)
                <div class="col-md-4 col-sm-6 portfolio-item center-block">
                    <a href="{{ "#" . $portfolio->slug }}" class="portfolio-link" data-toggle="modal" data-target="{{ "#" . $portfolio->slug }}"
                        @foreach($portfolio->images as $image)
                            @if($image->pivot->is_maskot == 1)
                                data-link="{{ asset($image->imageMid->location) }}"
                            @endif
                        @endforeach
                        >
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fa fa-info-circle fa-3x"></i>
                            </div>
                        </div>
                        @foreach($portfolio->images as $image)
                            @if($image->pivot->is_maskot == 1)
                                <img src="{{ asset($image->imageMid->location) }}" class="img-responsive img-rounded" alt="{{ $image->name }}" style="height:260px; width: 360px;">
                            @endif
                        @endforeach
                    </a>
                    <div class="portfolio-caption">
                        <h4>{{ ucfirst($portfolio->title) }}</h4>
                        <p class="text-muted">{{ $portfolio->category()->first()->category }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pull-right">
            {{ $portfolios->links('vendor/pagination/simplecustom') }}
        </div>
    </div>
</section>

<div class="portfolios-modal_container">
    @include('partials.modals._portfolio_modal')  
</div>