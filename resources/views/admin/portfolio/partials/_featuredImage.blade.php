<div class="row">
	@if($images->first())
		@foreach($images as $image)
			<div class="col-md-2 col-sm-6">
				<a href="javascript:" data-dismiss="modal" data-name="{{ url($image->thumbnail->location) }}" data-id="{{ $image->id }}" class="portfolio-featured-image">
					<div class="thumbnail">
						<img class="img-responsive thumbnail-img"	src="{{ url($image->thumbnail->location) }}" alt="{{ $image->name }}">
					</div>
				</a>
			</div>
		@endforeach
	@else
		<div class="alert alert-info">
			<h1 class="text-center">No image is available Please add new image</h1>
		</div>
	@endif
</div>