<div class="row">
	@if(count($images))
		@foreach($images as $image)
			<div class="col-md-2 col-sm-6">
				<div class="thumbnail">
					<a href="javascript:" class="img-gallery-link" data-id="{{ $image->id }}" data-name="{{ url($image->thumbnail->location) }}">
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
@if(count($images))
	<div class="row">
		<div class="col-sm-12">
			<a href="javascript:" id="add_gallery_btn" data-dismiss="modal">
				<button class="btn btn-sm pull-right">
					Add Gallery Images
				</button>
			</a>
		</div>
	</div>
@endif