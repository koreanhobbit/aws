<div class="row">
	@if (count($images))
		@foreach($images as $image)	
			<div class="col-md-2 col-sm-6">
				<div class="thumbnail">
					<a data-dismiss='modal' href="javascript:" class="featured-img-link" data-id="{{ $image->id }}" data-name="{{ url($image->thumbnail->location) }}" >
						<img class="img-responsive thumbnail-img" src="{{ url($image->thumbnail->location) }}" alt="{{ $image->name }}">
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