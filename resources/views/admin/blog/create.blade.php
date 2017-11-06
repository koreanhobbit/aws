@extends('admin.layouts.dashboard')
@section('page_heading','Blogs')
@section('section')
	<form action="{{route('blog.store')}}" method="POST">
		{{ csrf_field() }}
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						{{-- post panel --}}
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Create Post')
							@slot('panelBody')
								@if(count($errors) > 0)
									@foreach($errors->all() as $error)
										<div class="alert alert-danger">
											{{$error}}
										</div>
									@endforeach
								@endif
								<div class="form-group">
									<label for="blog-title">Title</label>
									<input type="text" class="form-control" name="title" id="blogtitle" value="{{ old('title') }}"	placeholder="Enter The Title" required>
								</div>

								<div class="form-group">
									<label for="blog-title">Slug</label>
									<input type="text" class="form-control" name="slug" id="blogslug" placeholder="Slug" value="{{ old('slug') }}"	required>
								</div>

								<div class="form-group">
									<label for="blog-source">Source Link&nbsp;<span><small>* if any</small></span></label>
									<input type="text" class="form-control" name="source" id="blogsource" placeholder="Source Link" value="{{ old('source') }}">
								</div>
								
								<div class="form-group">
									<label for="blogpost">Post</label>
									<textarea name="post" id="blogpost">
									{{ old('post') }}
									</textarea>
								</div>
							@endslot
						@endcomponent
					</div>
				</div>
				<div class="col-sm-3">
					{{-- categories panel --}}
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Category')
							@slot('panelBody')
								@foreach($cats as $key=>$cat)
									<div class="radio">
							          <label>
							          	<input name="category" value="{{ $cat->id }}" @if($key==0) checked @endif type="radio">
							          	{{ $cat->category }}
							          </label>
							        </div>
								@endforeach
								<a href="{{ route('category.index') }}"><span><i class="fa fa-plus"></i></span>&nbsp;Add Category</a>
							@endslot
						@endcomponent
					</div>
					{{-- featured image panel --}}
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Featured Image')
							@slot('panelBody')
								<div id="set-featured-img" data-urlfi="{{ route('blog.reloadfi') }}" data-urlgi="{{ route('blog.reloadgi') }}">
									<a type="button" data-target='#blog_featured_image' data-toggle='modal' onmouseover="this.style.cursor='pointer';">Set Featured Image</a>
								</div>

								<div id="remove-fm">
									<div class="thumbnail">
										<img src="" alt="" class="img-responsive thumbnail-img">
									</div>
									<div class="text-center">
										<a href="javascript:" class="btn btn-warning">Remove Featured Image</a>
									</div>
									
								</div>
								<input type="hidden" name="featuredimage" id="featured-image" value="">
							@endslot
						@endcomponent
					</div>
					{{-- images galery panel --}}
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Images Gallery')
							@slot('panelBody')
								<div class="row" id="gallerycontainer"></div>
									<div class="gallery" data-urlfi="{{ route('blog.reloadfi') }}" data-urlgi="{{ route('blog.reloadgi') }}">
										<a type="button" data-target='#images-gallery' data-toggle='modal' onmouseover="this.style.cursor='pointer';">Add Images For Gallery</a>
									</div>

							@endslot
						@endcomponent
					</div>

					{{-- submit panel --}}
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Publish')
							@slot('panelBody')
							<div class="row">
								<div class="col-sm-12">
									<button type="submit" class="btn btn-primary btn-sm form-control">Publish</button>
								</div>
							</div>
							@endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</form>
	@include('admin.blog.partials._modals')
@endsection
@section('script')
	<script>
		Dropzone.autoDiscover = false;	
	</script>
	@include('admin.blog.partials._script')
@endsection