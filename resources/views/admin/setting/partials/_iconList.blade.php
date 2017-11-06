@component('admin.widgets.panel')
	@slot('panelBody')
		<div class="row">
			@if (count($images) < 2)
				<div class="alert alert-info text-center">
					<h1>There Is No Image Available</h1>
				</div>
			@else
				@foreach($images as $image)
					@if ($image->id != 1)
						<div class="col-md-2 col-sm-2">
							<div class="thumbnail">
								<a href="javascript:" class="iconLink" data-link="{{ asset($image->path . $image->name) }}" data-imageid="{{ $image->id }}">
									<img src="{{ asset($image->path . $image->name) }}" alt="{{ $image->name }}" class="img-responsive thumbnail-img">
								</a>
							</div>
						</div>
					@endif
				@endforeach
			@endif
		</div>
	@endslot
@endcomponent