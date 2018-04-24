{{ csrf_field() }}
	<div class="row message">
		<h4></h4>
	</div>
	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelTitle1', 'Edit Portfolio')
		@endcomponent
	</div>
	<div class="row">
		<div class="col-sm-8">
			

			<div class="row">
				@component('admin.widgets.panel')
					@slot('panelBody')
						<div class="form-group">
							<label for="titlePorfolio">Title</label>
							<input type="text" class="form-control" placeholder="Title" name="titlePortfolio" id="titlePortfolio" value="{{ $pf->title }}">
						</div>
						<div class="form-group">
							<label for="slugPortfolio">Slug</label>
							<input type="text" class="form-control" placeholder="Slug" name="slugPortfolio" id="slugPortfolio" value="{{ $pf->slug }}">
						</div>
						<div class="form-group">
							<label for="clientPortfolio">Client Name</label>
							<input type="text" class="form-control" placeholder="Client Name" name="clientPortfolio" id="clientPortfolio" value="{{ $pf->client }}">
						</div>
						<div class="form-group">
							<label for="linkPortfolio">Link *If Available</label>
							<input type="text" class="form-control" placeholder="Link" name="linkPortfolio" id="linkPortfolio" value="{{ $pf->link }}">
						</div>
						<textarea name="descriptionPortfolio" id="descriptionPortfolio"> {{ $pf->description }} </textarea>
					@endslot
				@endcomponent
			</div>
		</div>
		<div class="col-sm-4">

			<div class="row">
				@component('admin.widgets.panel')
					@slot('panelTitle1', 'Categories')
					@slot('panelBody')
						@foreach($categories as $key => $category)
							<div class="radio">
								<label>
									<input type="radio" name="category" type="radio" @if($pf->portfolio_category_id == $category->id) checked @endif value="{{ $category->id }}">
									{{ $category->category }}
								</label>
							</div>
						@endforeach
					@endslot
				@endcomponent
			</div>

			<div class="row">
				@component('admin.widgets.panel')
					@slot('panelTitle1', 'Featured Image')
					@slot('panelBody')
						<div>
							<a href="portfolioFeaturedImage" data-toggle="modal" data-target="#portfolioFeaturedImage" id="addFeaturedImage" data-urlfi="{{ route('portfolio.reload') }}" data-urlgi="{{ route('portfolio.reload.gallery') }}">Set Featured Image</a>
						</div>

						<div class="removeFeaturedImage text-center">
							<div class="thumbnail">
								@foreach($pf->images as $image)
									@if($image->pivot->is_maskot == 1)
										<img src="{{ url($image->thumbnail->location) }}" alt="{{ $image->name }}" class="img-responsive">
									@endif
								@endforeach
							</div>
								<a href="javascript:" class="btn btn-warning">Remove Featured Image</a>
						</div>
					@endslot
				@endcomponent
			</div>

			<div class="row">
				@component('admin.widgets.panel')
					@slot('panelTitle1', 'Images Gallery')
					@slot('panelBody')
						<div class="row" id="gallerycontainer">
							@foreach($pf->images as $image)
								@if($image->pivot->is_maskot == 0)
									<div class="thumbnail col-sm-6 gallerydisplay" data-id="{{ $image->id }}">
										<img src="{{ url($image->thumbnail->location) }}" alt="{{ $image->name }}" class="img-responsive gal-img img-thumbnail">
										<div class="remove-img">
											<i class="fa fa-remove"></i>
										</div>
										<input type="hidden" name="{{ 'galleryimg[' . $image->id . ']' }}" value="{{ $image->id }}">
									</div>
								@endif
							@endforeach
						</div>
						<a href="#image-gallery" data-toggle="modal" data-target="#image-gallery" id="addGalleryImages" data-urlfi="{{ route('portfolio.reload') }}" data-urlgi="{{ route('portfolio.reload.gallery') }}">Add Gallery Images</button></a>
					@endslot
				@endcomponent
			</div>

			<div class="row">
				@component('admin.widgets.panel')
					@slot('panelTitle1', 'Select Action')
					@slot('panelBody')
						<div class="row">
							<div class="col-sm-6">
								<button class="btn btn-primary form-control editBtn" data-id="{{ $pf->images()->firstOrFail()->id }}">Edit</button>
							</div>
							<div class="col-sm-6">
								<a href="{{ route('portfolio.index') }}">
									<button class="form-control btn btn-warning cancelBtn">Cancel Edit</button>
								</a>
							</div>
						</div>
					@endslot
				@endcomponent
			</div>
		</div>
	</div>
	@include('admin.portfolio.partials._modal')
