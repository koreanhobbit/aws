@foreach($posts as $post)
    <div class="home-modal modal fade" id="{{ $post->slug }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <h2 class="text-center" style="overflow-wrap: break-word;">{{ $post->title }}</h2>
                                <br>
                                <br>
                                <br>
                                
                                @foreach($post->images as $image)
                                    @if($image->pivot->is_maskot == 1)
                                        <img class="img-responsive img-centered main-img" src="{{ asset($image->imageMid->location) }}" title="{{ $image->name }}">
                                    @endif
                                 @endforeach

                                <div class="row">    
                                    @foreach($post->images->sortBy('id') as $image)                                
                                        @if($image->pivot->is_maskot == 1)    
                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                <a href="javascript:" class="img-gallery main-img-gallery" data-url="{{ asset($image->imageMid->location) }}"> <img src="{{ asset($image->thumbnail->location) }}" alt="" class="img-responsive img-thumbnail selected_img" style="height: 110px;min-height: 110px;"></a>
                                            </div>    
                                        
                                        @elseif($image->pivot->is_maskot == 0)    
                                            <div class="col-md-2 col-sm-4 col-xs-4">
                                                <a href="javascript:" class="img-gallery" data-url="{{ asset($image->imageMid->location) }}"> <img src="{{ asset($image->thumbnail->location) }}" title="{{ $image->name }}" class="img-responsive img-thumbnail" style="height: 110px;min-height: 110px;"></a>   
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                                               
                                <div class="text-justify">{!! $post->post !!}
                                    <br>
                                    @if(!empty($post->source))
                                        <a href="{{ $post->source }}" target="_blank">
                                            <p><span><i class="fa fa-newspaper-o">&nbsp;</i></span> Source</p>
                                        </a>
                                    @endif
                                </div>                                
                                
                                <ul class="list-inline">
                                    <li><span><i class="fa fa-user"></i></span> {{ ucfirst($post->user->name) }}</li>
                                    <li><span><i class="fa fa-calendar"></i></span> {{ $post->created_at->diffForHumans() }}</li>
                                    {{-- <li>Client: Round Icons</li> --}}
                                    <li><span><i class="fa fa-list-alt"></i></span> {{ $post->blogcategory->category }}</li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Blog Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach