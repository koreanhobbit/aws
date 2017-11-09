@extends('admin.layouts.dashboard')
@section('page_heading','Blogs')
@section('section')
	<form action="{{route('blog.update',['blog'=>$blog->id])}}" method="POST">
		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<div class="col-sm-12">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Edit Post')
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
									<input type="text" class="form-control" name="title" id="blogtitle" value="{{ $blog->title }}"	placeholder="Enter The Title" required>
								</div>

								<div class="form-group">
									<label for="blog-title">Slug</label>
									<input type="text" class="form-control" name="slug" id="blogslug" placeholder="Slug" value="{{ $blog->slug }}"	required>
								</div>

								<div class="form-group">
									<label for="blog-source">Source Link&nbsp;<span><small>* if any</small></span></label>
									<input type="text" class="form-control" name="source" id="blogsource" placeholder="Source Link" value="{{ $blog->source }}">
								</div>
								
								<div class="form-group">
									<label for="blogpost">Post</label>
									<textarea name="post" id="blogpost">
									{{ $blog->post }}
									</textarea>
								</div>

							@endslot
						@endcomponent
					</div>
				</div>
				<div class="col-sm-3">
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Category')
							@slot('panelBody')
								@foreach($cats as $cat)
									<div class="radio">
							          <label>
							          	<input name="category" value="{{$cat->id}}" @if($cat->id == $blog->blogcategory_id)checked @endif type="radio">{{$cat->category}}
							          </label>
							        </div>
								@endforeach
								<a href="{{ route('category.index') }}"><span><i class="fa fa-plus"></i></span>&nbsp;Add Category</a>
							@endslot
						@endcomponent
					</div>
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Featured Image')
							@slot('panelBody')
								<div id="set-featured-img" data-urlfi="{{ route('blog.reloadfi') }}" data-urlgi="{{ route('blog.reloadgi') }}">
									<a type="button" data-target='#blog_featured_image' data-toggle='modal' onmouseover="this.style.cursor='pointer';">Set Featured Image</a>
								</div>
								<div id="remove-fm">
									@foreach($blog->images as $feat)
										@if($feat->pivot->is_maskot == 1)
											<div class="thumbnail">
												<img src="{{ url($feat->path) }}" alt="{{ $feat->name }}" class="img-responsive thumbnail-img">
											</div>
											<input type="hidden" name="featuredimage" id="featured-image" value="{{ $feat->id }}">
										@endif
									@endforeach
									<div class="text-center">
										<a href="javascript:" class="btn btn-warning">Remove Featured Image</a>
									</div>
								</div>
							@endslot
						@endcomponent
					</div>
					{{-- images galery panel --}}
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Images Gallery')
							@slot('panelBody')
								<div class="row" id="gallerycontainer">
									@foreach($blog->images as $blog)
										@if($blog->pivot->is_maskot == 0)
											<div class="thumbnail col-sm-6 gallerydisplay" data-id="{{ $blog->id }}">
												<img src="{{ url($blog->path) }}" alt="{{ $blog->name }}" class="img-responsive gal-img">
												<div class="remove-img">
													<i class="fa fa-remove"></i>
												</div>
												<input type="hidden" name="galleryimg[{{ $blog->id }}]" value="{{ $blog->id }}">
											</div>
										@endif
									@endforeach
								</div>
									<div class="gallery" data-urlfi="{{ route('blog.reloadfi') }}" data-urlgi="{{ route('blog.reloadgi') }}">
										<a type="button" data-target='#images-gallery' data-toggle='modal' onmouseover="this.style.cursor='pointer';">Add Images For Gallery</a>
									</div>
							@endslot
						@endcomponent
					</div>
					<div class="row">
						@component('admin.widgets.panel')
							@slot('class', 'default')
							@slot('panelTitle1', 'Publish')
							@slot('panelBody')
								<div class="row">
									<div class="col-sm-12">
										<button type="submit" class="btn btn-primary btn-sm form-control">Edit</button>
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
		$(document).ready(function() {
			// hide set featured image link and show featured image
			$("#set-featured-img").hide();
			$("#remove-fm").show();
		});
	</script>
	<script>
		Dropzone.autoDiscover = false;	
	</script>
	@include('admin.blog.partials._script')
@endsection