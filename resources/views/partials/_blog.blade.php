{{-- blog grid section --}}
    <section id="blogs" class="bg-light-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Blog</h2>
                    <h3 class="section-subheading text-muted">Get the latest information here.</h3>
                </div>
            </div>
            <div class="row">
            	@foreach($posts as $post)
                    @foreach($post->images as $image)
                        @if($image->pivot->is_maskot == 1)
                            @php
                                $imagePath = $image->imageMid->location;
                                $imageName = $image->name;
                                $imageLink = $image->imageMid->location;
                            @endphp
                        @endif
                    @endforeach
	                <div class="col-md-4 card_blog">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <img src="{{ asset($imagePath) }}" class="img-responsive img-rounded" alt="{{ $imageName }}" style="height:260px; width:360px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="{{ $post->slug }}" data-toggle="modal" data-target="#{{ $post->slug }}" data-link="{{ asset($imageLink) }}" class="blog-modal-link">
                                            <h6 class="text-center" style="overflow-wrap: break-word;min-height: 50px;">{{ $post->title }}</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        @php
                                            $string = ucfirst(strip_tags($post->post));
                                            if(strlen(strip_tags($post->post)) > 100) {
                                                $stringCut= substr(strip_tags($post->post), 0, 100);
                                                $string = substr($stringCut, 0, strrpos($stringCut, ' ')).'....';
                                            }
                                        @endphp

                                        <p class="text-muted text-justify" style="height: 50px"> {{ $string }} </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="" data-toggle="modal" data-target="#{{ $post->slug }}" data-link="{{ asset($imageLink) }}" class="blog-modal-link">Read Details <span class="
                                            pull-right"><i class="fa fa-arrow-circle-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
	                </div>
	            @endforeach
            </div>
            <div class="pull-right">
                {{ $posts->links('vendor/pagination/simplecustom') }}
            </div>
        </div>
    </section>

    <div class="blog-modal-container">
        @include('partials.modals._blog_modal')
    </div>