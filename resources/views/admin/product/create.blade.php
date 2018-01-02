@extends('admin.layouts.dashboard')
@section('page_heading', 'Create Product')
@section('section')
	<form action="{{ route('product.store') }}" method="POST">
		{{ csrf_field() }}
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-7">
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Create Product')
							@slot('panelBody')
								<div class="form-group {{ $errors->has('name_product') ? 'has-error' : '' }}">
									<label for="name_product">
										Name 
									</label>
									<input class="form-control" type="text" name="name_product" id="name_product" value="{{ old('name_product') }}" placeholder="Enter the product name">
									@if($errors->has('name_product'))
										<span class="help-block">
											<strong>
												{{ $errors->first('name_product') }}
											</strong>
										</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('slug_product') ? 'has-error' : '' }}">
									<label for="slug_product">
										Slug
									</label>
									<input type="text" name="slug_product" id="slug_product" value="{{ old('slug_product') }}" placeholder="Enter the slug" class="form-control">
									@if($errors->has('slug_product'))
										<span class="help-block">
											<strong>
												{{ $errors->first('slug_product') }}
											</strong>
										</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('price_product') ? 'has-error' : '' }}">
									<label for="price_product">
										Price
									</label>
									<input type="text" name="price_product" id="price_product" value="{{ old('price_product') }}" placeholder="Enter the price" class="form-control">
									@if($errors->has('price_product'))
										<span class="help-block">
											<strong>
												{{ $errors->first('price_product') }}
											</strong>
										</span>
									@endif
								</div>
								<div class="form-group {{ $errors->has('sale_price_product') ? 'has-error' : '' }}">
									<label for="sale_price_product">
										Sale Price
									</label>
									<input type="text" name="sale_price_product" id="sale_price_product" value="{{ old('sale_price_product') }}" placeholder="Enter the sale price" class="form-control">
									@if($errors->has('sale_price_product'))
										<span class="help-block">
											<strong>
												{{ $errors->first('sale_price_product') }}
											</strong>
										</span>
									@endif
								</div>
								@foreach($parameters as $par)
									<div class="form-group {{ $errors->has($par->id_name) ? 'has-error' : '' }}">
										<label for="{{ $par->id_name }}">
											{{ $par->name }}
										</label>
										<input type="text" name="{{ $par->id_name }}" id="{{ $par->id_name }}" value="{{ old($par->id_name) }}" placeholder="{{ $par->placeholder }}" class="form-control">
										@if($errors->has($par->id_name))
											<span class="help-block">
												<strong>
													{{ $errors->first($par->id_name) }}
												</strong>
											</span>
										@endif
									</div>
								@endforeach
								<div class="form-group {{ $errors->has('description_product') ? 'has-error' : '' }}">
									<label for="description_product">
										Description
									</label>
									<textarea name="description_product" id="description_product">
										{{ old('description_product') }}
									</textarea>
									@if($errors->has('description_product'))
										<span class="help-block">
											<strong>
												{{ $errors->first('description_product') }}
											</strong>
										</span>
									@endif
								</div>
							@endslot
						@endcomponent
					</div>
				</div>
				<div class="col-sm-5">
					@component('admin.widgets.panel')
						@slot('panelTitle1', 'Category')
						@slot('panelBody')
							@foreach($categories as $cat)
								<div class="radio">
									<label>
										<input type="radio" name="category_product" id="category_product" value="{{ $cat->id }}">
										{{ $cat->name }}
									</label>
								</div>
							@endforeach
							@if($errors->has('category_product'))
							<div class="has-error">
								<span class="help-block">
									<strong>
										{{ $errors->first('category_product') }}
									</strong>
								</span>
							</div>
							@endif
						@endslot
					@endcomponent

					@component('admin.widgets.panel')
						@slot('panelTitle1', 'Featured Image')
						@slot('panelBody')
							<a href="javascript:" class="add_fi" data-toggle="modal" data-target="#product_featured_image" data-urlfi="{{ route('product.reloadfi') }}" data-urlgi="{{ route('product.reloadgi') }}">
								<button class="btn btn-sm btn-info">
									Add Featured Image
								</button>
							</a>
							<div class="remove_fi hidden">
								<div class="thumbnail">
									<img src="" title="" class="img-responsive">
								</div>
								<div class="text-center">
									<a href="javascript:" class="btn btn-sm btn-primary">
										Remove Featured Image
									</a>
								</div>
							</div>
							<input type="hidden" name="featuredimage" class="featuredimage" value="">
						@endslot
					@endcomponent

					@component('admin.widgets.panel')
						@slot('panelTitle1', 'Gallery Images')
						@slot('panelBody')
							<div class="row">
								<div class="col-sm-12">
									<div id="gallerycontainer">
										
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<a href="javascript:" class="add_gi" data-toggle="modal" data-target="#product_gallery" data-urlfi="{{ route('product.reloadfi') }}" data-urlgi="{{ route('product.reloadgi') }}">
										Add Gallery Images
									</a>
								</div>
							</div>
						@endslot
					@endcomponent
					@component('admin.widgets.panel')
						@slot('panelTitle1', 'Submit')
						@slot('panelBody')
							<div class="col-sm-6">
								<button type="submit" class="btn btn-primary btn-sm form-control btn-publish">
									Publish
								</button>
							</div>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-default btn-sm form-control btn-draft">
									Draft
								</button>
							</div>
							<input type="hidden" class="is_published" name="is_published" value="">
						@endslot
					@endcomponent
					@component('admin.widgets.panel')
						@slot('panelTitle1', 'Cancel Create Product')
						@slot('panelBody')
							<div class="col-sm-12">
								<a href="{{ route('product.index') }}">
									<span class="icon-prev">
										<i class="fa fa-arrow-circle-left"></i>
									</span>
									Go Back to Product List
								</a>
							</div>
						@endslot
					@endcomponent
				</div>
			</div>			
		</div>
	</form>
	@include('admin.product.partials._modals')
@endsection

@section('script')
	@include('admin.product.partials._script_create')
@endsection