@if(session()->has('message') && count($portfolios))	
	<div class="row alert alert-success message">
		<h4>{{ session()->get('message') }}</h4>
	</div>
@endif

@if(!count($portfolios))
	<div class="row">
		<div class="alert alert-info">
			<h1 class="text-center">There is no portfolio, please add one</h1>
		</div>
	</div>
@else
	<div class="row">
		@component('admin.widgets.panel')	
			@slot('panelTitle1','All Portfolios')
		@endcomponent
	</div>

	<div class="row">
		@component('admin.widgets.panel')
			@slot('panelBody')
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table class="table table-condensed table-striped">
								<thead>
									<tr>
										<td class="col">No</td>
										<td class="col-md-2">Image</td>
										<td class="col-md-2">Title</td>
										<td class="col-md-3">Description</td>
										<td class="col-md-3">Link</td>
										<td class="col">Edit</td>
										<td class="col">Delete</td>
									</tr>
								</thead>
								<tbody>
									@foreach($portfolios as $key => $portfolio)
										<tr>
											<td>{{ $portfolios->firstItem() + $key }}</td>
											<td>
												<div class="thumbnail">
													<img src="{{ url($portfolio->images()->firstOrFail()->thumbnail->location) }}" alt="" class="img-responsive" style="height:150px; min-height: 150px">
												</div>
											</td>
											<td>{{ $portfolio->title }}</td>
											<td>{{ strip_tags($portfolio->description) }}</td>
											<td><a href="{{ $portfolio->link }}" target="_blank">{{ $portfolio->link }}</a></td>
											<td>
												<a href="javascript:" class="editBtn" data-urlEdit="{{ route('portfolio.edit', ['pf' => $portfolio->id]) }}" data-urlUpdate="{{ route('portfolio.update', ['pf' => $portfolio->id]) }}">
													<span class="btn btn-info btn-sm">
														<i class="fa fa-edit"></i>
													</span>
												</a>
											</td>
											<td>
												<a href="javascript:" class="deleteBtn" data-url="{{ route('portfolio.destroy', ['pf' => $portfolio->id]) }}">
													<span class="btn btn-danger btn-sm">
														<i class="fa fa-trash-o"></i>
													</span>
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			@endslot
		@endcomponent
	</div>
	<div class="row text-center">
		{{ $portfolios->withPath('portfolio') }}
	</div>
@endif
	@can('access-portfolio')
		<div class="row">
			<button class="btn btn-primary pull-right" id="addPortfolio" data-url="{{ route('portfolio.create') }}" data-urlstore="{{ route('portfolio.store') }}" style="margin-right: 20px; margin-bottom: 50px;">Add New Portfolio</button>
		</div>
	@endcan
