@extends('admin.layouts.dashboard')
@section('page_heading','Blogs')

@section('section')
	<div class="col-sm-12">
		@if(!count($posts_perpage))
			<div class="alert alert-info text-center">
				<h1>There is no post</h1>
			</div>
		@else
			@if (session()->has('message'))
				<div class="alert alert-info">
					<h4>{{ session()->get('message') }}</h4>
				</div>
			@endif

			@component('admin.widgets.panel')	
				@slot('panelTitle1','All Posts')
				@slot('panelBody')
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-condensed table-striped">
									<thead>
										<tr>
											<td class="col-md-6">
												Title
											</td>
											<td class="col-md-2">
												Author
											</td>
											<td class="col-md-2">
												Categories
											</td>
											<td class="col-md-2">
												Date
											</td>
											<td>
												Edit
											</td>
											<td>
												Delete
											</td>

										</tr>
									</thead>
									<tbody>
										@foreach( $posts_perpage as $post )
											<tr>
												<td>
													<a href="{{ route('blog.edit', ['blog'=>$post->id]) }}">{{ ucfirst(strip_tags($post->title)) }}</a>
												</td>
												<td>
													{{ ucfirst($post->user->name) }}
													
												</td>
												<td>
													{{ ucfirst($post->blogcategory->category) }}
												</td>
												<td>
													@if($post->is_published === 0)
														{{ "Draft" }}
													@else

														{{ "Published" }}
													@endif
													<br>
													{{$post->updated_at->diffForHumans()}}
												</td>
												<td>
													<a href="{{ route('blog.edit', ['blog'=>$post->id]) }}"><button class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></button></a>
												</td>
												<td>
													<form action="{{ route('blog.destroy', ['blog'=>$post->id]) }}" method="POST">
														{{ method_field('DELETE') }}
														{{ csrf_field() }}
														<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><span class="fa fa-trash-o"></span></button>
													</form>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col text-center">
							<span>{{ $posts_perpage->links() }}</span>
						</div>
					</div>
				
				@endslot
			@endcomponent
		@endif
	</div>
@endsection