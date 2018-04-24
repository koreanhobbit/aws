<div class="row">
	@if(count($images))
		@foreach($images as $image)
			<div class="col-md-2 col-sm-6">
				<div class="thumbnail">
					<a href="javascript:" data-name="{{ url($image->thumbnail->location) }}" data-id="{{ $image->id }}" class="portfolio-gallery-image">
						<img class="img-responsive thumbnail-img"	src="{{ url($image->thumbnail->location) }}" alt="{{ $image->name }}">
					</a>
				</div>
			</div>
		@endforeach
	@else
		<div class="alert alert-info">
			<h1 class="text-center">No image is available Please add new image</h1>
		</div>
	@endif
</div>
<br>
<div class="row">
	@if(count($images))
		<a href="javascript:" class="btn btn-primary" id="addGalleryBtn" data-dismiss="modal" style="margin-left: 20px;">Add Gallery</a>
	@endif
</div>