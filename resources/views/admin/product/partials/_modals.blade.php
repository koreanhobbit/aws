{{-- modal for featured image --}}
	@component('admin.widgets.modal')
		@slot('modalClass', 'full-modal')
		@slot('modalId', 'product_featured_image')
		@slot('modalTitle','Upload Featured Image')
		@slot('modalBody')
			@component('admin.widgets.panel')
				@slot('class', 'default')
				@slot('panelTitle1', 'Choose Featured Image')
				@slot('panelBody')
					<ul class="nav nav-tabs" style="margin-bottom: 20px;">
						<li class="active" id="featuredImageList"><a href="#featuredImageTab" data-toggle="tab">Featured Image</a></li>
						<li class="" id="uploadFeaturedImageList"><a href="#uploadFeaturedImageTab" data-toggle="tab">Upload Featured Image</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="featuredImageTab">
							@include('admin.product.partials._featuredimage')
						</div>
						<div class="tab-pane fade" id="uploadFeaturedImageTab">
							@component('admin.widgets.panel')
								@slot('panelBody')
									<form id="featuredImageDz" class="dropzone" method="POST" action="{{ route('image.store') }}">
										{{ csrf_field() }}
										<div class="fallback">
							    			<input name="file" type="file" multiple />
							  			</div>
										<h3 class="text-center">Drop your image inside the box or click to add the link</h3>
									</form>
								@endslot
							@endcomponent
						</div>
					</div>
				@endslot
			@endcomponent
		@endslot
	@endcomponent
	{{-- modal for images gallery --}}
	@component('admin.widgets.modal')
		@slot('modalClass', 'full-modal')
		@slot('modalId', 'product_gallery')
		@slot('modalTitle','Upload Images For Gallery')
		@slot('modalBody')
			@component('admin.widgets.panel')
				@slot('class', 'default')
				@slot('panelTitle1', 'Choose Gallery Image')
				@slot('panelBody')
					<ul class="nav nav-tabs" style="margin-bottom: 20px;">
						<li class="active" id="galleryImageList"><a href="#galleryImageTab" data-toggle="tab">Gallery Image</a></li>
						<li class="" id="uploadGalleryImageList"><a href="#uploadGalleryImageTab" data-toggle="tab">Upload Gallery Image</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="galleryImageTab">
							@include('admin.product.partials._galleryimages')
						</div>
						<div class="tab-pane fade" id="uploadGalleryImageTab">
							@component('admin.widgets.panel')
								@slot('panelBody')
									<form id="galleryImageDz" class="dropzone" method="POST" action="{{ route('image.store') }}">
										{{ csrf_field() }}
										<div class="fallback">
							    			<input name="file" type="file" multiple />
							  			</div>
										<h3 class="text-center">Drop your image inside the box or click to add the link</h3>
									</form>
								@endslot
							@endcomponent
						</div>
					</div>
				@endslot
			@endcomponent
		@endslot
	@endcomponent