{{-- product promotion grid section --}}
    <section id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Product</h2>
                    <h3 class="section-subheading text-muted">Some of our services.</h3>
                </div>
            </div>
            <div class="row">
            	@foreach($products as $product)
                    @if($product->is_published == 1)
    	                <div class="col-md-4 card_product">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <a href="{{ $product->slug }}" data-toggle="modal" data-target="#{{ $product->slug }}" @foreach($product->images as $image) @if($image->pivot->is_maskot == 1) data-link="{{ asset($image->imageMid->location) }}" @endif @endforeach class="product-modal-link">
                                                <h5 class="text-center" style="overflow-wrap: break-word;min-height: 20px;">
                                                    {{ $product->name }}
                                                </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                	<div class="row">
                                        <div class="col-xs-12">
                                        	<h2 class="text-center" style="background-color: lightblue">
                                        		{{ '$ ' . number_format($product->price, 0, '.', ',') }}/Month
                                        	</h2>
                                            @foreach($product->parameters as $par)
                                            	<h5 class="text-center">
                                            		{{ $par->pivot->value }}
                                            	</h5>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class="col-xs-12">
                                        	<div class="text-center">
    	                                    	<a href="{{ $product->slug }}" data-target="#{{ $product->slug }}" @foreach($product->images as $image) @if($image->pivot->is_maskot == 1) data-link="{{ asset($image->imageMid->location) }}" @endif @endforeach data-toggle="modal" class="btn btn-primary product-modal-link">
    	                                    		Get This Package
    	                                    	</a>
                                        	</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    	                </div>
                    @endif
	            @endforeach
            </div>
            <div class="pull-right">
                {{ $products->links('vendor/pagination/simplecustom') }}
            </div>
        </div>
    </section>

    <div class="blog-modal-container">
        @include('partials.modals._product_modal')
    </div>