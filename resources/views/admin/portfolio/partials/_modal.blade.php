{{-- modal for featured image --}}
	@component('admin.widgets.modal')
		@slot('modalClass', 'full-modal')
		@slot('modalId', 'portfolioFeaturedImage')
		@slot('modalTitle', 'Featured Image')
		@slot('modalBody')
			@component('admin.widgets.panel')
				@slot('panelTitle1', 'Choose Featured Image')
			@endcomponent
			@component('admin.widgets.panel')
				@slot('panelBody')
					<ul class="nav nav-tabs" style="margin-bottom: 20px;">
						<li class="active" id="featuredImageList"><a href="#featuredImageTab" data-toggle="tab">Featured Image</a></li>
						<li class="" id="uploadFeaturedImageList"><a href="#uploadFeaturedImageTab" data-toggle="tab">Upload Featured Image</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="featuredImageTab">
							@include('admin.portfolio.partials._featuredImage')
						</div>
						<div class="tab-pane fade" id="uploadFeaturedImageTab">
							@component('admin.widgets.panel')
								@slot('panelBody')
									<form id="featuredImageDz" class="dropzone" method="POST" action="{{route('image.store')}}">
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

{{-- modal for gallery images --}}
	@component('admin.widgets.modal')
		@slot('modalClass', 'full-modal')
		@slot('modalId', 'image-gallery')
		@slot('modalTitle', 'Images Gallery')
		@slot('modalBody')
			@component('admin.widgets.panel')
				@slot('panelTitle1', 'Choose Images')
				@slot('panelBody')
					<ul class="nav nav-tabs" style="margin-bottom: 20px;"> 
						<li class="active" id="listGalleryImage"><a href="#listGalleryImageTab" data-toggle="tab">Images List</a></li>
						<li class="" id="uploadGalleryImage"><a href="#uploadGalleryImageTab" data-toggle="tab">Upload Images List</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane fade active in" id="listGalleryImageTab">
							@include('admin.portfolio.partials._galleryImage')	
						</div>
						<div class="tab-pane fade" id="uploadGalleryImageTab">
							@component('admin.widgets.panel')
								@slot('panelBody')
									<form id="galleryImagesDz" class="dropzone" method="POST" action="{{ route('image.store') }}">
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