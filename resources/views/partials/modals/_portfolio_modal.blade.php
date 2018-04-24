<!-- Portfolio Modals -->
    @foreach($portfolios as $portfolio)
        <!-- Portfolio Modal -->
        <div class="home-modal modal fade" id="{{ $portfolio->slug }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl">
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-lg-offset-2">
                                <div class="modal-body">
                                    <!-- Project Details Go Here -->
                                    <h2>{{ $portfolio->title }}</h2>
                                    @if(!empty($portfolio->link)) <p class="item-intro text-muted"><span><a href="{{ $portfolio->link }}" target="_blank">{{ $portfolio->link }}</a></span></p> @else <br> <br> @endif
                                    @foreach($portfolio->images as $image)
                                        @if($image->pivot->is_maskot == 1)
                                            <img class="img-responsive img-centered main-img" src="{{ asset($image->imageMid->location) }}" alt="">
                                        @endif
                                     @endforeach
                                    <div class="row">    
                                        @foreach($portfolio->images->sortBy('id') as $image)                                
                                            @if($image->pivot->is_maskot == 1)    
                                                <div class="col-md-2 col-sm-4 col-xs-4">
                                                    <a href="javascript:" class="img-gallery main-img-gallery" data-url="{{ asset($image->imageMid->location) }}"> <img src="{{ asset($image->thumbnail->location) }}" alt="" class="img-responsive img-thumbnail selected_img" style="height: 110px;min-height: 110px;"></a>
                                                </div>    
                                            @endif
                                            @if($image->pivot->is_maskot == 0)    
                                                <div class="col-md-2 col-sm-4 col-xs-4">
                                                   
                                                    <a href="javascript:" class="img-gallery" data-url="{{ asset($image->imageMid->location) }}"> <img src="{{ asset($image->thumbnail->location) }}" alt="" class="img-responsive img-thumbnail" style="height: 110px;min-height: 110px;"></a>
                                                    
                                                </div>    
                                            @endif
                                        @endforeach
                                    </div>
                                    <p>{!! $portfolio->description !!}</p>
                                    <ul class="list-inline">
                                        <li><span><i class="fa fa-calendar"></i> &nbsp;{{ $portfolio->updated_at->diffForHumans() }}</span></li>
                                        <li><span><i class="fa fa-list-alt"></i>&nbsp;{{ $portfolio->category->category }}</span></li>
                                        <li><span><i class="fa fa-user"></i>&nbsp;Client:&nbsp;{{ ucfirst($portfolio->client) }}</span></li>
                                    </ul>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
