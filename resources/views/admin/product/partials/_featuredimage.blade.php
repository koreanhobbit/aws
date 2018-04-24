<div class="row">
	@if(count($images)) 
		@foreach($images as $image)
			<div class="col-md-2 col-sm-6">
				<div class="thumbnail">
					<a href="javascript:" data-dismiss="modal" class="featured-img-link" data-id="{{ $image->id }}" data-name="{{ url($image->thumbnail->location) }}">
						<img class="img-responsive thumbnail-img" src="{{ url($image->thumbnail->location) }}" title="{{ $image->name }}">
					</a>
				</div>
			</div>
		@endforeach
	@else
		<div class="col-sm-12">
			<h2 class="alert alert-info">
				There is no image please add first..
			</h2>
		</div>
	@endif
</div>