{{ csrf_field() }}
	<div class="row message">
		<h4></h4>
	</div>
	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelTitle1', 'Add New Portfolio')
		@endcomponent
	</div>
	<div class="row">
		<div class="col-sm-8">
			<div class="row">
				@component('admin.widgets.panel')
					@slot('panelBody')
						<div class="form-group">
							<label for="titlePorfolio">Title</label>
							<input type="text" class="form-control" placeholder="Title" name="titlePortfolio" id="titlePortfolio">
						</div>
						<div class="form-group">
							<label for="slugPortfolio">Slug</label>
							<input type="text" class="form-control" placeholder="Slug" name="slugPortfolio" id="slugPortfolio">
						</div>
						<div class="form-group">
							<label for="clientPortfolio">Client Name</label>
							<input type="text" class="form-control" placeholder="Client Name" name="clientPortfolio" id="clientPortfolio">
						</div>
						<div class="form-group">
							<label for="linkPortfolio">Link *If Available</label>
							<input type="text" class="form-control" placeholder="Link" name="linkPortfolio" id="linkPortfolio">
						</div>
						<textarea name="descriptionPortfolio" id="descriptionPortfolio"></textarea>
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
									<input type="radio" name="category" type="radio" @if($key == 0) checked @endif value="{{ $category->id }}">
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
							<a href="#portfolioFeaturedImage" data-toggle="modal" data-target="#portfolioFeaturedImage" id="addFeaturedImage" data-urlfi="{{ route('portfolio.reload') }}" data-urlgi="{{ route('portfolio.reload.gallery') }}">Set Featured Image</a>
						</div>

						<div class="removeFeaturedImage text-center">
							<div class="thumbnail">
								<img src="" alt="" class="img-responsive">
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
						<div class="col-sm-12">
							<button class="btn btn-primary form-control submitBtn" data-id="">Publish</button>
						</div>
					</div>
					@endslot
				@endcomponent
			</div>
		</div>
	</div>
	
